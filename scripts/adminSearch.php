<?php
include '../core/init.php';
include '../classes/DB.php';
include '../classes/Config.php';
include '../classes/SearchServiceMgr.php';

if(isset($_POST['searchTerm'])){
    $results = SearchServiceMgr::searchTerm($_POST['searchTerm'], 5, false);
    foreach($results as $result){
        ?>
        <a href="profilePage.php?uid=<?php echo $result->user_id;?>">
            <div class="display_box">
                <div class="row">
                    <div class="col-lg-12 col-md-12 col-sm-12">
                        <div class="media">
                            <div class="media-left">
                                <img  height="48" width="48" class="media-object" src="../<?php echo DB::getInstance()->query("SELECT image_path FROM images WHERE user_id = '$result->user_id' && image_id = '1'")->results()[0]->image_path;?>"/>
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