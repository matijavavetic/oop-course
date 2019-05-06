<?php

require_once("includes/init.php");
require_once("includes/header.php");

$session->userLogout();
redirect("login.php");