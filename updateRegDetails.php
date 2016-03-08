<?php
include 'classes/UserServiceMgr.php';


// Can not send sensitive info via GET  - TO BE FIXED!!!!!!

if($_GET['Send']== 'Apply Changes'){
    unset($_GET['Send']);
}

$keys = array("Username","First_Name", "Last_Name", "Password" , "Email");

for($i=0; $i<count($keys); $i++){
    if($_GET[$keys[$i]]== ''){
        unset($_GET[$keys[$i]]);
    }

}

//to be deleted when database working
UserServiceMgr::testFunction($_GET);


//userid taken from global values

//this wont work until database is sorted and working
//UserServiceMgr::updateUserHobbies($userid, $changes);
?>