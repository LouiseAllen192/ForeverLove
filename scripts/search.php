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
        <div class="display_box" align="left">
            <img src="https://s3.amazonaws.com/uifaces/faces/twitter/calebogden/48.jpg" style="width: 48px; height: 48px; float: left; margin-right: 6px;"/>
            <span class="name"><?php echo $result->username ?></span>
            &nbsp;<br>
            <?php echo $result->tag_line; ?><br>
            <span style="font-size: 9px; color: #999999"><?php echo $result->city; ?></span>
        </div>
        <?php
    }
}
?>