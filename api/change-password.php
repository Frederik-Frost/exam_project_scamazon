<?php
require_once(__DIR__.'/../globals.php');

// validate password
if( !isset($_POST['old_password']) ){_res('400', ['info' => 'Password required']);}
if( strlen($_POST['old_password']) < _PASSWORD_MIN_LEN ){_res('400', ['info' => 'Password must be at least '. _PASSWORD_MIN_LEN .' characters']);}
if( strlen($_POST['old_password']) > _PASSWORD_MAX_LEN ){_res('400', ['info' => 'Password can be no more than '. _PASSWORD_MAX_LEN .' characters']);}
// validate new password
if( !isset($_POST['new_password']) ){_res('400', ['info' => 'New password required']);}
if( strlen($_POST['new_password']) < _PASSWORD_MIN_LEN ){_res('400', ['info' => 'New password must be at least '. _PASSWORD_MIN_LEN .' characters']);}
if( strlen($_POST['new_password']) > _PASSWORD_MAX_LEN ){_res('400', ['info' => 'New password can be no more than '. _PASSWORD_MAX_LEN .' characters']);}

$db = _api_db();

try{
    $q = $db->prepare('SELECT * FROM users WHERE id = :id');
    $q->bindValue(':id', $_POST['user_id']);   
    $q->execute();
    $row = $q->fetch();
    if(!$row){_res('400', ['info' => 'Could not find user', 'error' =>__LINE__]);}
    else {
        $passwordVerification = password_verify($_POST['old_password'], $row['password']);
        if(!$passwordVerification){
            {_res('400', ['info' => 'Wrong old password', 'error' =>__LINE__]);}
        } else{
                try{
                    // Success 
                    $password = $_POST['new_password'];
                    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                    $q = $db->prepare('UPDATE users SET password = :password WHERE id = :id');
                    $q->bindValue(':id', $_POST['user_id']);
                    $q->bindValue(':password', $hashedPassword);   
                    $q->execute();
                    _res('200', ['info' => 'Successfully changed password']);
                } catch(Exception $ex){
                    _res('500', ['info' => 'System under maintainance', 'error' => __LINE__]);
                }
            }
    }

} catch(Exception $ex){
    _res('500', ['info' => 'System under maintainance', 'error' => __LINE__]);
}