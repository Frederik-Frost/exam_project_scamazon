<?php
require_once(__DIR__.'/../globals.php');
$db = _api_db();

//Validate
$target_dir = __DIR__."/../assets/product-images/";
$target_file_delete = $target_dir.basename($_POST['image_path']);
$target_file_upload = $target_dir.basename($_FILES["image"]["name"]);
$image_file_type = strtolower(pathinfo($target_file_upload,PATHINFO_EXTENSION));

// Checking if there is a file uploaded in the form
if(!isset($_FILES['image']) || strlen($_FILES['image']['name']) <= 0){_res('400',[ "info" => "No image uploaded"]);}
//Checking if the file uploaded is actually an image by trying to get the size. 
$check_image = getimagesize($_FILES['image']['tmp_name']);
if($check_image == false){_res('400',[ "info" => "File is not an image"]);}
if($image_file_type != "jpg" && $image_file_type != "png" && $image_file_type != "jpeg"){_res('400',[ "info" => "Image must be of type jpg, png, jpeg"]);}
// Check if file already exists
if(file_exists($target_file)){_res('400',[ "info" => "This file already exists"]);}
//Check if filesize is too large
if ($_FILES["image"]["size"] > 500000) {_res('400',[ "info" => "File is too large - Maximum 500KB"]);}

if(!isset($_POST['id'])){_res('400', ['info' => 'No id']);}
if(strlen($_POST['id']) != 32){_res('400', ['info' => 'Not a valid id']);}
try{
    $q = $db->prepare('UPDATE products SET image_path = :image_path WHERE id = :id');
    $q->bindValue(':image_path', $_FILES['image']['name']);
    $q->bindValue(':id', $_POST['id']);
    $q->execute();

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file_upload);
    unlink($target_file_delete);

    _res('200', ["info" => "Succesfully updated image"]);
}catch(Exception $ex){
    _res('500', ["info" => "System under maintainance".__LINE__]);
}