<?php
include("classes/classes.php");
$_SESSION["email"] = "valentinbriezbanuls@gmail.com";
if(!isset($_SESSION["email"])){
    header("Location: login.php");
//    echo "test";
} else {
    session_start();
}