<?php

class Session {

    private $signedIn = false;
    public $userID;

    function __construct()
    {
        session_start();
        $this->checkLoginStatus();
    }

    private function checkLoginStatus()
    {
        if(isset($_SESSION['userID'])) {
            $this->userID = $_SESSION['userID'];
            $this->signedIn = true;
        } else {

            unset($this->userID);
            $this->signedIn = false;
        }
    }

    public function isUserSingedIn()
    {
        return $this->signedIn;
    }

    public function userLogin ($user)
    {
        if($user) {
            $this->userID = $_SESSION['userID'] = $user->id;
            $this->signedIn = true;
        }
    }

    public function userLogout ($user)
    {
        unset($_SESSION['userID']);
        unset($this->userID);
        $this->signedIn = false;
    }
}

$session = new Session();