<?php
//Send email with link to reset password
require_once(__DIR__.'/../globals.php');
$db = _api_db();
//Validate email
if( !isset($_POST['email']) ){_res('400',  "Email is required");}
if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) ){_res('400',["info" => "Email is invalid"]);}



try{
    $query = $db->prepare('SELECT * FROM users WHERE email = :email');
    $query->bindValue(":email", $_POST['email']);
    $query->execute();
    $row = $query->fetch();
    if(!$row){_res('400', ["info" => "Not a user"]);}
    else {
        // Found user - now send an email
        $_to_name = $row['name'];
        $_to_email = $row['email'];
        $_reset_password_key = $row['password_reset_key'];
        $_message = "Seems like you have forgotten your password? <a href='http://localhost:8888/reset-password?key=$_reset_password_key'>Click here to reset your password</a>";
        require_once(__DIR__."/../private/send_email.php");
        _res('200',["info" => "Email sent"]);
    }
} catch(Exception $ex){
    http_response_code(500);
    $errResponse = ["info" => 'System under maintainance '.__LINE__];
    echo json_encode($errResponse);
    exit();
}







