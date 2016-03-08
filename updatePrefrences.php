<?php
include 'classes/UserServiceMgr.php';


// About me not sending - TO BE FIXED!!!!!!
if(isset($_GET['About_Me'])){
    echo "is set!!!!";
}

if($_GET['Tag_Line']== ''){
    unset($_GET['Tag_Line']);
}
if($_GET['City']== ''){
    unset($_GET['City']);
}

if($_GET['Send']== 'Apply Changes'){
    unset($_GET['Send']);
}

//to be deleted when database working
UserServiceMgr::testFunction($_GET);


//userid taken from global values

//this wont work until database is sorted and working
//UserServiceMgr::updateUserHobbies($userid, $changes);
?>