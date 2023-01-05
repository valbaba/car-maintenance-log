<?php
include("classes/classes.php");

$phpConfig = new PHPConfig;


// Sessions & php configs

$phpConfig->setSessionsLife();

$phpConfig->setCookiesLife();

$phpConfig->createSession();

if(!isset($_SESSION["email"])){
    header("Location: login.php");
}
