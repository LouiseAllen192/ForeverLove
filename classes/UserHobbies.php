<?php


class Hobbies{

    private $userID, $reading, $cinema, $shopping, $socializing, $travelling, $walking;
    private $exercise, $soccer, $dancing, $horses, $running, $eatingOut, $painting, $cooking;
    private $computers, $bowling, $writing, $skiing, $crafts, $golf, $chess, $gymnastics;
    private $cycling, $swimming, $surfing, $hiking, $videoGames, $vollyball, $badminton;
    private $gym, $parkour, $fashion, $yoga, $basketball, $boxing;
    private $uniqueHobby;


    public function __construct($uid, $hobbies){
        $this->userID = $uid;
        $this->reading = $hobbies->Reading;
        $this->cinema = $hobbies->Cinema;
        $this->shopping = $hobbies->Shopping;
        $this->socializing = $hobbies->Socializing;
        $this->travelling = $hobbies->Travelling;
        $this->walking = $hobbies->Walking;
        $this->exercise = $hobbies->Exercise;
        $this->soccer = $hobbies->Soccer;
        $this->dancing = $hobbies->Dancing;
        $this->horses = $hobbies->Horses;
        $this->running = $hobbies->Running;
        $this->eatingOut = $hobbies->Eating_Out;
        $this->painting = $hobbies->Painting;
        $this->cooking = $hobbies->Cooking;
        $this->computers = $hobbies->Computers;
        $this->bowling = $hobbies->Bowling;
        $this->writing = $hobbies->Writing;
        $this->skiing = $hobbies->Skiing;
        $this->crafts = $hobbies->Crafts;
        $this->golf = $hobbies->Golf;
        $this->chess = $hobbies->Chess;
        $this->gymnastics = $hobbies->Gymnastics;
        $this->cycling = $hobbies->Cycling;
        $this->swimming = $hobbies->Swimming;
        $this->surfing = $hobbies->Surfing;
        $this->hiking = $hobbies->Hiking;
        $this->videoGames = $hobbies->Video_Games;
        $this->vollyball = $hobbies->VolleyBall;
        $this->badminton = $hobbies->Badminton;
        $this->gym = $hobbies->Gym;
        $this->parkour = $hobbies->Parkour;
        $this->fashion = $hobbies->Fashion;
        $this->yoga = $hobbies->Yoga;
        $this->basketball = $hobbies->Basketball;
        $this->boxing = $hobbies->Boxing;
        $this->uniqueHobby = $hobbies->Unique_Hobbie;

    }

    public function getUserID(){
        return $this->userID;
    }

    public function getReading(){
        return $this->reading;
    }

    public function getCinema(){
        return $this->cinema;
    }

    public function getShopping(){
        return $this->shopping;
    }

    public function getSocializing(){
        return $this->socializing;
    }

    public function getTravelling(){
        return $this->travelling;
    }

    public function getWalking()
    {
        return $this->walking;
    }

    public function getExercise(){
        return $this->exercise;
    }

    public function getSoccer(){
        return $this->soccer;
    }

    public function getDancing(){
        return $this->dancing;
    }

    public function getHorses(){
        return $this->horses;
    }

    public function getRunning(){
        return $this->running;
    }

    public function getEatingOut(){
        return $this->eatingOut;
    }

    public function getPainting(){
        return $this->painting;
    }

    public function getCooking(){
        return $this->cooking;
    }

    public function getComputers(){
        return $this->computers;
    }

    public function getBowling(){
        return $this->bowling;
    }

    public function getWriting(){
        return $this->writing;
    }

    public function getSkiing(){
        return $this->skiing;
    }

    public function getCrafts(){
        return $this->crafts;
    }

    public function getGolf(){
        return $this->golf;
    }

    public function getChess(){
        return $this->chess;
    }

    public function getGymnastics(){
        return $this->gymnastics;
    }

    public function getCycling(){
        return $this->cycling;
    }

    public function getSwimming(){
        return $this->swimming;
    }

    public function getSurfing(){
        return $this->surfing;
    }

    public function getHiking(){
        return $this->hiking;
    }

    public function getVideoGames(){
        return $this->videoGames;
    }

    public function getVollyball(){
        return $this->vollyball;
    }

    public function getBadminton(){
        return $this->badminton;
    }

    public function getGym(){
        return $this->gym;
    }

    public function getParkour(){
        return $this->parkour;
    }

    public function getFashion(){
        return $this->fashion;
    }

    public function getYoga(){
        return $this->yoga;
    }

    public function getBasketball(){
        return $this->basketball;
    }

    public function getBoxing(){
        return $this->boxing;
    }

    public function getUniqueHobby(){
        return $this->uniqueHobby;
    }
}

?>