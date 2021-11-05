<?php
require_once(__DIR__.'/../globals.php');
// validate login email
if(!isset($_POST['email'])){_res('400', ['info' => 'Email required']);}
if (! filter_var($_POST['email'], FILTER_VALIDATE_EMAIL) ){ _res('400', ['info'  => 'Not an email']);}

// validate login password
if( !isset($_POST['password']) ){_res('400', ['info' => 'Password required']);}
if( strlen($_POST['password']) < _PASSWORD_MIN_LEN ){_res('400', ['info' => 'Password must be at least '. _PASSWORD_MIN_LEN .' characters']);}
if( strlen($_POST['password']) > _PASSWORD_MAX_LEN ){_res('400', ['info' => 'Password can be no more than '. _PASSWORD_MAX_LEN .' characters']);}

try{
 $db = _api_db();
} catch(Exception $ex){
    _res(500, ['info' => 'System under maintainance', 'error' => __LINE__]);
}

try{
    $q = $db->prepare('SELECT * FROM users WHERE email = :email');
    $q->bindValue(':email', $_POST['email']);   
    $q->execute();
    $row = $q->fetch();
    if(!$row){_res(400, ['info' => 'Could not find user', 'error' =>__LINE__]);}
    if($row['verified'] == 0 ){_res(400, ['info' => 'Account is not yet verified', 'error' =>__LINE__]);}
    else {
        $passwordVerification = password_verify($_POST['password'], $row['password']);
        if(!$passwordVerification){
            {_res(400, ['info' => 'Wrong password', 'error' =>__LINE__]);}
        } else{
            // Success 
            session_start();
            $_SESSION['user_name'] = $row['name'];
            $_SESSION['user_last_name'] = $row['last_name'];
            _res('200', ['info' => 'Successfully logged in']);
        }
    }
} catch(Exception $ex){
    _res(500, ['info' => 'System under maintainance', 'error' => __LINE__]);
}