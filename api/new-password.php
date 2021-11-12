<?php
require_once(__DIR__.'/../globals.php');

// validate password
if( !isset($_POST['password']) ){_res('400', ['info' => 'Password required']);}
if( strlen($_POST['password']) < _PASSWORD_MIN_LEN ){_res('400', ['info' => 'Password must be at least '. _PASSWORD_MIN_LEN .' characters']);}
if( strlen($_POST['password']) > _PASSWORD_MAX_LEN ){_res('400', ['info' => 'Password can be no more than '. _PASSWORD_MAX_LEN .' characters']);}
// validate new password
if( !isset($_POST['repeatPassword']) ){_res('400', ['info' => 'New password required']);}
if( strlen($_POST['repeatPassword']) < _PASSWORD_MIN_LEN ){_res('400', ['info' => 'New password must be at least '. _PASSWORD_MIN_LEN .' characters']);}
if( strlen($_POST['repeatPassword']) > _PASSWORD_MAX_LEN ){_res('400', ['info' => 'New password can be no more than '. _PASSWORD_MAX_LEN .' characters']);}

if($_POST['repeatPassword'] != $_POST['password']){_res('400', ['info' => 'Repeat password does not match password']);}
//To do: Verify the key (must be 32 characters)
if(!isset($_POST['key'])){_res('400', ['info' => 'No key']);}
if(strlen($_POST['key']) != 32){_res('400', ['info' => 'Not a valid key']);}

$db = _api_db();
try{
    $password = $_POST['password'];
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $q = $db->prepare('UPDATE users SET password = :password, password_reset_key = :new_password_reset_key WHERE password_reset_key = :password_reset_key');
    $q->bindValue(':password', $hashedPassword);
    $q->bindValue(':password_reset_key', $_POST['key']);
    $q->bindValue(':new_password_reset_key', bin2hex(random_bytes(16)));
    $q->execute();
    if(!$q->rowCount()) {
    _res('400', ['info' => 'Wrong key']);
    } else{
        $response = ["info" => "Succesfully set a new password"];
        echo json_encode($response);
        exit;
    
    }
} catch(Exception $ex){
    http_response_code(500);
    $response = ["info" => "System under maintainance".__LINE__];
    echo json_encode($response);
}