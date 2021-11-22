<?php
require_once(__DIR__.'/../globals.php');
$db = _api_db();
//Validate
$target_dir = __DIR__."/../assets/product-images/";
$target_file = $target_dir.basename($_FILES["image"]["name"]);
$image_file_type = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

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

//Image is ready to be uploaded to the folder. $_FILES['image']['name'] will be the filepath for the image column in db
//Now validate the rest of the upload
if(!isset($_POST['title_en']) && !isset($_POST['title_da'])){ _res('400',[ "info" => "Product needs a title in both danish and english"]);}
if((strlen($_POST['title_en']) || strlen($_POST['title_da']) ) < _PRODUCT_MIN_LEN){ _res('400',[ "info" => "Title length must be at least "._PRODUCT_MIN_LEN." characters"]);}
if((strlen($_POST['title_en']) || strlen($_POST['title_da']) ) > _PRODUCT_MAX_LEN){ _res('400',[ "info" => "Title length can be no longer than "._PRODUCT_MAX_LEN." characters"]);}

if(!isset($_POST['price']) || $_POST['price'] == ''){ _res('400',[ "info" => "Product needs a price"]);}

if(!isset($_POST['description_en']) && !isset($_POST['description_da'])){ _res('400',[ "info" => "Product needs a description in both danish and english"]);}
if((strlen($_POST['description_da']) || strlen($_POST['description_da']) ) > _PRODUCT_MAX_LEN){ _res('400',[ "info" => "Title length can be no longer than "._DESCRIPTION_MAX_LEN." characters"]);}
//filepath $_FILES['image']['name'];
// move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
try{
    $item_id = bin2hex(random_bytes(16));
    $q = $db->prepare('INSERT INTO products VALUES(:id, :title_en, :title_da, :price, :description_en, :description_da, :image_path)');
    $q->bindValue(':id', $item_id);
    $q->bindValue(':title_en', $_POST['title_en']);
    $q->bindValue(':title_da', $_POST['title_da']);
    $q->bindValue(':price', $_POST['price']);
    $q->bindValue(':description_en', $_POST['description_en']);
    $q->bindValue(':description_da', $_POST['description_da']);
    $q->bindValue(':image_path', $_FILES['image']['name']);
    $q->execute();

    move_uploaded_file($_FILES["image"]["tmp_name"], $target_file);
    _res('200', ["info" => "Successfully uploaded a product", "data" => $_POST, "file" => $_FILES, "id" => $item_id]);
}catch(Exception $ex){
    _res('500', ["info" => "System under maintainance".__LINE__]);
}
