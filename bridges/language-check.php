<?php
    session_start();
    // Languages : da, en
    if(!isset($_SESSION['application_language'])){
        //Set english as the default language 
        $_SESSION['application_language'] = 'en';
        exit();
    } 