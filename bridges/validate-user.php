<?php

//To do: Verify the key (must be 32 characters)
if(!isset($_GET['key'])){
    echo "mmm..... suspicious (key is missing)";
    exit();
}
if(strlen($_GET['key']) != 32){
    echo "mmm..... suspicious (key is not 32 chars)";
    exit();
}

//To do: Connect to the db
require_once(__DIR__.'/../globals.php');
$db = _api_db();
//To do: update the verified to 1 if match
try{
    $q = $db->prepare('UPDATE users SET verified = :verify WHERE verification_key = :verification_key');
    $q->bindValue(':verify', 1);
    $q->bindValue(':verification_key', $_GET['key']);
    $q->execute();
    if(mysqli_affected_rows($mysqli) > 0) {
        echo "mmm..... suspicious (keys dont match)";
        exit();
    } else{
        // echo '["message" => "user verified"]';
        header('Location: login');
    }
}catch(Exception $ex){
    http_response_code(500);
    echo "System under maintainance";
    exit();
}

// if( $_GET['key'] != $data['verification_key']){
//     echo "mmm..... suspicious (keys dont match)";
//     exit();
// }
// $data = json_decode(file_get_contents("data.json"), true);
// echo $data->verification_key; // json 
// echo $data['verification_key']; // associative array



//To do: Say congrats to the user
// $data['verified'] = 1; // Update command

// file_put_contents("data.json", json_encode($data, JSON_PRETTY_PRINT));
// echo "Congrats you are verified!";

