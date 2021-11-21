<?php
    session_start();
    if(!isset($_SESSION['user_name'])){
        header('Location: login?loginNeeded='.$_SERVER['REQUEST_URI']);
        exit();
    }