<?php
require_once(__DIR__.'/../globals.php');

$db = _api_db();
$productId = $_GET['item_id'];
try{
    $q = $db->prepare('DELETE FROM products WHERE id = :id');
    $q->bindValue(':id', $productId);
    $q->execute();
    _res('200',["info" => "Product deleted"]);
}catch(Exception $ex){
    http_response_code(500);
    echo "System under maintainance".__LINE__;
}