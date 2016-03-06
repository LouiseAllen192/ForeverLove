<?php
include 'classes/UserServiceMgr.php';

$changes = array();

$keys = array('Reading','Cinema','Shopping','Socializing','Travelling',
    'Walking','Exercise','Soccer','Dancing', 'Horses','Running','Eating_Out',
    'Painting', 'Cooking', 'Computers', 'Bowling', 'Writing', 'Skiing', 'Crafts',
    'Golf', 'Chess', 'Gymnastics','Cycling','Swimming','Surfing','Hiking','Video_Games',
    'Volleyball','Badminton','Gym','Parkour','Fashion','Yoga','Basketball','Boxing', 'Unique_Hobbie');

for($i=0; $i<count($keys) ; $i++){
    if(!isset ($_GET[$keys[$i]])) {
        $changes[$keys[$i]] = "0";
    } else {
        $changes[$keys[$i]] = "1";
    }
}

if(isset ($_GET['Unique_Hobbie'])){ $changes['Unique_Hobbie'] = $_GET['Unique_Hobbie'];}
if($changes['Unique_Hobbie']== ''){ unset($changes['Unique_Hobbie']);}


UserServiceMgr::testFunction($changes);

    //userid taken from global values
    //this wont work until database is sorted and working
    //UserServiceMgr::updateUserHobbies($userid, $changes);
?>