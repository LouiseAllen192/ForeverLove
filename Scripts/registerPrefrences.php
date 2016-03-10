<?php
include($_SERVER['DOCUMENT_ROOT'].'/classes/UserServiceMgr.php');


// About me not sending - TO BE FIXED!!!!!!
if(isset($_GET['About_Me'])){
    echo "is set!!!!";
}

if($_GET['Tag_Line']== ''){
    $_GET['Tag_Line'] = 'Unselected';
}
if($_GET['City']== ''){
    $_GET['City'] = 'Unselected';
}

if($_GET['Send']== 'Apply Changes'){
    unset($_GET['Send']);
}

//to be deleted when database working
UserServiceMgr::testFunction($_GET);

//userid taken from global values

//this wont work until database is sorted and working
//UserServiceMgr::updateUserPrefrences($changes, $userid);

?>