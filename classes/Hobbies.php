<?php


class Hobbies{

    private $userID;
    private $reading;
    private $cinema;
    private $shopping;
    private $socializing;
    private $travelling;
    private $walking;
    private $exercise;
    private $soccer;
    private $dancing;
    private $horses;
    private $running;
    private $eatingOut;
    private $painting;
    private $cooking;
    private $computers;
    private $bowling;
    private $writing;
    private $skiing;
    private $crafts;
    private $golf;
    private $chess;
    private $gymnastics;
    private $cycling;
    private $swimming;
    private $surfing;
    private $hiking;
    private $videoGames;
    private $vollyball;
    private $badminton;
    private $gym;
    private $parkour;
    private $fashion;
    private $yoga;
    private $basketball;
    private $boxing;
    private $uniqueHobby;





    public function __construct($uid, $red, $cin, $shop, $soci, $trav, $walk, $ex, $soc, $dan, $hor, $run,
                                $eato, $paint, $cook, $comp, $bowl, $writ, $ski, $cra, $gol, $che, $gymna,
                                $cyc, $swim, $surf, $hik, $vidg, $volly, $badm, $gy, $park, $fas, $yog,
                                $baskb, $box, $uni){
        $this->userID = $uid;
        $this->reading = $red;
        $this->cinema = $cin;
        $this->shopping = $shop;
        $this->socializing = $soci;
        $this->travelling = $trav;
        $this->walking = $walk;
        $this->exercise = $ex;
        $this->soccer = $soc;
        $this->dancing = $dan;
        $this->horses = $hor;
        $this->running = $run;
        $this->eatingOut = $eato;
        $this->painting = $paint;
        $this->cooking = $cook;
        $this->computers = $comp;
        $this->bowling = $bowl;
        $this->writing = $writ;
        $this->skiing = $ski;
        $this->crafts = $cra;
        $this->golf = $gol;
        $this->chess = $che;
        $this->gymnastics = $gymna;
        $this->cycling = $cyc;
        $this->swimming = $swim;
        $this->surfing = $surf;
        $this->hiking = $hik;
        $this->videoGames = $vidg;
        $this->vollyball = $volly;
        $this->badminton = $badm;
        $this->gym = $gy;
        $this->parkour = $park;
        $this->fashion = $fas;
        $this->yoga = $yog;
        $this->basketball = $baskb;
        $this->boxing = $box;
        $this->uniqueHobby = $uni;


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