<?php
include '../core/init.php';
include '../classes/DB.php';
include '../classes/Config.php';

if(isset($_POST['searchTerm'])){
    $_SESSION['user_id'] = 0;/********************************************************************************************/
    $term = $_POST['searchTerm'];
    $sql = "SELECT user_id, username, email, tag_line, city, gender, seeking ".
        "FROM registration_details JOIN preference_details USING(user_id) ".
        "WHERE user_id != '".$_SESSION['user_id']."' && ".
        "(username LIKE '%$term%' || email LIKE '%$term%' || tag_line LIKE '%$term%') ".
        "ORDER BY user_id LIMIT 5";
    $results = DB::getInstance()->query($sql)->results();
    foreach($results as $result){
        ?>
        <div class="display_box">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12">
                    <div class="media">
                        <div class="media-left">
                            <img class="media-object" src="https://s3.amazonaws.com/uifaces/faces/twitter/calebogden/48.jpg"/>
                        </div>
                        <div class="media-body" style="padding-top: 3px;">
                            <h4 class="media-heading"><?php echo $result->username; ?></h4>
                            <small><?php echo $result->tag_line; ?></small>
                        </div>
                        <div class="media-right media-middle">
                            <h5 class="media-heading"><?php echo $result->city; ?></h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
?>