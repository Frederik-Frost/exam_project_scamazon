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

try{
    $db = _api_db();
} catch(Exception $ex){
    http_response_code(500);
    echo json_encode(['info' => 'System under maintainance', 'error' => __LINE__]);
}

//Validate firstName
if( !isset($_POST['name']) ){send_400("Name is required");}
if( strlen($_POST['name']) < _NAME_MIN_LEN ){send_400("Name must be at least 2 characters");}
if( strlen($_POST['name']) > _NAME_MAX_LEN ){send_400("Name cannot be more than 40 characters");}

//Validate lastName
if( !isset($_POST['lastName']) ){send_400("Last name is required");}
if( strlen($_POST['lastName']) < _NAME_MIN_LEN ){send_400("Last name must be at least 2 characters");}
if( strlen($_POST['lastName']) > _NAME_MAX_LEN ){send_400("Last name cannot be more than 40 characters");}

//Validate email
if( !isset($_POST['email']) ){send_400("Email is required");}
if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) ){send_400('Email is invalid');}


if( !isset($_POST['password']) ){send_400("Please provide a password");}
if( strlen($_POST['password']) < _PASSWORD_MIN_LEN ){send_400('Password must be at least '. _PASSWORD_MIN_LEN .' characters');}
if( strlen($_POST['password']) > _PASSWORD_MAX_LEN ){send_400('Password can be no more than '. _PASSWORD_MAX_LEN .' characters');}

if( !isset($_POST['phone']) ){send_400("Please provide a phone number");}
if( strlen($_POST['phone']) != 8 ){send_400("This is not a valid phone number");}

$password = $_POST['password'];
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

// Insert data in the DB
try{
    $query = $db->prepare('SELECT * FROM users WHERE email = :email');
    $query->bindValue(":email", $_POST['email']);
    $query->execute();
    $row = $query->fetch();
    if($row){send_400('Email is already in use');}
    else { 
        try{
            $user_id = bin2hex(random_bytes(16));
            $query = $db->prepare('INSERT INTO users VALUES(:email, :name, :last_name, :phone, :password, :id)');
            $query->bindValue(":id", $user_id);
            $query->bindValue(":name", $_POST['name']);
            $query->bindValue(":last_name", $_POST['lastName']);
            $query->bindValue(":email", $_POST['email']);
            $query->bindValue(":phone", $_POST['phone']);
            $query->bindValue(":password", $hashedPassword);
            $query->execute();
        
            $response = ["info" => "User created", "user_id" => $user_id];
            echo json_encode($response);
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

// Function to manage error responding
function send_400($errorMessage){
    header('Content-Type: application/json');
    http_response_code(400);
    $response = ["info" => $errorMessage];
    echo json_encode($response);
    exit(); // can also use die(); or exit;
}