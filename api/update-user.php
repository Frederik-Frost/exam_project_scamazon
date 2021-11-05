<?php
require_once(__DIR__.'/../globals.php');
$db = _api_db();

//Validate
if( !isset($_POST['name']) ){_res('400',[ "info" => "Name is required"]);}
if( strlen($_POST['name']) < _NAME_MIN_LEN ){_res('400',[ "info" => "Name must be at least 2 characters"]);}
if( strlen($_POST['name']) > _NAME_MAX_LEN ){_res('400',[ "info" => "Name cannot be more than 40 characters"]);}

if( !isset($_POST['lastName']) ){_res('400',[ "info" => "Last name is required"]);}
if( strlen($_POST['lastName']) < _NAME_MIN_LEN ){_res('400',[ "info" => "Last name must be at least 2 characters"]);}
if( strlen($_POST['lastName']) > _NAME_MAX_LEN ){_res('400',[ "info" => "Last name cannot be more than 40 characters"]);}

if( !isset($_POST['email']) ){_res('400',[ "info" => "Email is required"]);}
if( !filter_var($_POST['email'], FILTER_VALIDATE_EMAIL ) ){_res('400',[ "info" => 'Email is invalid']);}

if( !isset($_POST['phone']) ){_res('400',[ "info" => "Please provide a phone number"]);}
if( strlen($_POST['phone']) != 8 ){_res('400',[ "info" => "This is not a valid phone number"]);}

try{
    $q = $db->prepare('UPDATE users SET name = :name, last_name = :last_name, phone = :phone, email = :email WHERE id = :id');
    $q->bindValue(':name', $_POST['name']);
    $q->bindValue(':last_name', $_POST['lastName']);
    $q->bindValue(':phone', $_POST['phone']);
    $q->bindValue(':email', $_POST['email']);
    $q->bindValue(':id', $_POST['id']);
    $q->execute();
    $response = ["info" => "Succesfully updated", "id" => $_POST['id'],"name" => $_POST['name'], "lastName" => $_POST['lastName'], "phone" => $_POST['phone'], "email" => $_POST['email'], "updated" => true];
    echo json_encode($response);

}catch(Exception $ex){
    http_response_code(500);
    echo "System under maintainance".__LINE__;
}