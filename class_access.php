<?php

class Cars {

    // public = može se koristiti bilo gdje
    public $wheel_count = 4;
    // private = može se koristiti samo unutar zadane klase
    private $door_count = 4;
    // protected = može se koristiti samo unutar zadane klase i njenih podklasa
    protected $seat_count = 2;

    function car_detail () {
        echo $this->wheel_count;
        echo $this->door_count;
        echo $this->seat_count;
    }



}

$bmw = new Cars();

//echo $bmw->wheel_count;
//echo $bmw->door_count;
//echo $bmw->seat_count;

$bmw->car_detail();