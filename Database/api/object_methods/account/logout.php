<?php 
    session_start(); 
    $_SESSION['user'] = null; 
    unset($_SESSION['user']);
    $_SESSION["login"] = "0";
    unset($_SESSION['login']);
    $_SESSION["doctor"] = "0";
    unset($_SESSION['doctor']);
    session_destroy(); 
    header("location: ../../../../Website/index.html"); ?>