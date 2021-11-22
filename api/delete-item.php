<?php
require_once(__DIR__.'/../globals.php');

$db = _api_db();
$productId = $_POST['id'];
$image_path = $_POST['image_path'];
$target_dir = __DIR__."/../assets/product-images/";
$target_file = $target_dir.basename($image_path);  
try{
    $q = $db->prepare('DELETE FROM products WHERE id = :id');
    $q->bindValue(':id', $productId);
    $q->execute();
    // Deleting photo from product-images
    unlink($target_file);
    _res('200',["info" => "Product deleted"]);
} catch(Exception $ex){
    _res('500', ["info" => "System under maintainance".__LINE__]);
}