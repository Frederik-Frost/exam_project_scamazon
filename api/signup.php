<?php
//APIs almost never reply with HTML
//APIs almost always reply with JSON and HTTP status codes
// 200 = ok (everything in 200, -> e.g. 201, 202, 204)
// 30x = redirect - In APIs almost never used
// 40x = client error -
// 50x = server error -

// VALIDATE THE DATA

//ERROR FIRST'
require_once(__DIR__.'/../globals.php');
$db = _api_db();

//Validate firstName
if( !isset($_POST['name']) ){_res('400',['info' => "Name is required"]);}
if( strlen($_POST['name']) < _NAME_MIN_LEN ){_res('400',['info' => "Name must be at least 2 characters"]);}
if( strlen($_POST['name']) > _NAME_MAX_LEN ){_res('400',['info' => "Name cannot be more than 40 characters"]);}

//Validate lastName
if( !isset($_POST['lastName']) ){_res('400',['info' => "Last name is required"]);}
if( strlen($_POST['lastName']) < _NAME_MIN_LEN ){_res('400',['info' => "Last name must be at least 2 characters"]);}
if( strlen($_POST['lastName']) > _NAME_MAX_LEN ){_res('400',['info' => "Last name cannot be more than 40 characters"]);}

//Validate email
if( !isset($_POST['email']) ){_res('400',['info' => "Email is required"]);}
if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) ){_res('400',['info' => 'Email is invalid']);}


if( !isset($_POST['password']) ){_res('400',['info' => "Please provide a password"]);}
if( strlen($_POST['password']) < _PASSWORD_MIN_LEN ){_res('400',['info' => 'Password must be at least '. _PASSWORD_MIN_LEN .' characters']);}
if( strlen($_POST['password']) > _PASSWORD_MAX_LEN ){_res('400',['info' => 'Password can be no more than '. _PASSWORD_MAX_LEN .' characters']);}

if( !isset($_POST['phone']) ){_res('400',['info' => "Please provide a phone number"]);}
if( strlen($_POST['phone']) != 8 ){_res('400',['info' => "This is not a valid phone number"]);}

$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert data in the DB
try{
    $query = $db->prepare('SELECT * FROM users WHERE email = :email');
    $query->bindValue(":email", $_POST['email']);
    $query->execute();
    $row = $query->fetch();
    if($row){_res('400', 'Email is already in use');}
    else { 
        try{
            $user_id = bin2hex(random_bytes(16));
            $user_verification_key = bin2hex(random_bytes(16));
            $password_reset_key = bin2hex(random_bytes(16));
            $query = $db->prepare('INSERT INTO users VALUES(:email, :name, :last_name, :phone, :password, :id, :verified, :verification_key, :password_reset_key)');
            $query->bindValue(":id", $user_id);
            $query->bindValue(":name", $_POST['name']);
            $query->bindValue(":last_name", $_POST['lastName']);
            $query->bindValue(":email", $_POST['email']);
            $query->bindValue(":phone", $_POST['phone']);
            $query->bindValue(":password", $hashedPassword);
            $query->bindValue(":verified", 0);
            $query->bindValue(":verification_key", $user_verification_key);
            $query->bindValue(":password_reset_key", $password_reset_key);
            $query->execute();
        
            $response = ["info" => "User created", "user_id" => $user_id, "user_phone" => $_POST['phone'], "user_name" => $_POST['name'], "created" => true];
            echo json_encode($response);
        
            //Send verification email to the new user
            $_to_name = $_POST['name'];
            $_to_email = $_POST['email'];
            $_message = "Thank you for signing up.  <a href='http://localhost:8888/validate-user?key=$user_verification_key'>Click here to verify your account </a>";
            require_once(__DIR__."/../private/send_email.php");
                
        } catch(Exception $ex){
            http_response_code(500);
            $errResponse = ["info" => 'System under maintainance '.__LINE__];
            echo json_encode($errResponse);
            exit();
        }
    }   
    
} catch(Exception $ex){
    http_response_code(500);
    $errResponse = ["info" => 'System under maintainance '.__LINE__];
    echo json_encode($errResponse);
    exit();
}
