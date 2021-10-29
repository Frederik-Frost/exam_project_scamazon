<?php

require_once('globals.php');

// validate login email
if(!isset($_POST['email'])){_res('400', ['info' => 'Email required']);}
if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){ _res('400', ['info'  => 'Not an email']);}

// validate login password
if( !isset($_POST['password']) ){_res('400', ['info' => 'Password required']);}
if( strlen($_POST['password']) < _PASSWORD_MIN_LEN ){_res('400', ['info' => 'Password must be at least '. _PASSWORD_MIN_LEN .' characters']);}
if( strlen($_POST['password']) > _PASSWORD_MAX_LEN ){_res('400', ['info' => 'Password can be no more than '. _PASSWORD_MAX_LEN .' characters']);}


try{
 $db = _db();
} catch(Exception $ex){
    _res(500, ['info' => 'System under maintainance', 'error' => __LINE__]);
}

try{
    $q = $db->prepare('SELECT * FROM users WHERE user_email = :user_email');
    $q->bindValue(':user_email', $_POST['email']);   
    $q->execute();
    $row = $q->fetch();
    if(!$row){_res(400, ['info' => 'Wrong credentials', 'error' =>__LINE__]);}
    // Success 
    session_start();
    $_SESSION['user_name'] = $row['user_name'];
    $_SESSION['user_last_name'] = $row['user_last_name'];
    _res('200', ['info' => 'Successfully logged in']);

}catch(Exception $ex){
    _res(500, ['info' => 'System under maintainance', 'error' => __LINE__]);
}

