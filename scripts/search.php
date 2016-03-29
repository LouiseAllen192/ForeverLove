<?php
include '../core/init.php';
include '../classes/DB.php';
include '../classes/Config.php';
include '../classes/SearchServiceMgr.php';

if(isset($_POST['searchTerm'])){
    $me = $_SESSION['user_id'];
    $term = $_POST['searchTerm'];
    $sql = "SELECT user_id, username, email, city, tag_line, gender, seeking";
    $sql .= " FROM registration_details JOIN preference_details USING(user_id)";
    $sql .= " WHERE user_id != $me && (username LIKE '%$term%' || email LIKE '%$term%' || city LIKE '%$term%')";
    $sql .= " ORDER BY username LIKE '%$term%' DESC, email LIKE '%$term%' DESC, city LIKE '%$term%' DESC LIMIT 5";
    $results = SearchServiceMgr::filterSeekingGender($me, DB::getInstance()->query($sql)->results());
    foreach($results as $result){
        ?>
        <a href="profilePage.php?uid=<?php echo $result->user_id;?>">
            <div class="display_box">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="media">
                            <div class="media-left">
                                <img class="media-object" src="https://s3.amazonaws.com/uifaces/faces/twitter/calebogden/48.jpg"/>
                            </div>
                            <div class="media-body" style="padding-top: 3px;">
                                <h4 class="media-heading"><?php echo $result->username; ?></h4>
                                <small style="white-space: nowrap;"><?php echo $result->tag_line; ?></small>
                            </div>
                            <div class="media-right media-middle">
                                <h5 class="media-heading"><?php echo $result->city; ?></h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
        <?php
    }
}
?>