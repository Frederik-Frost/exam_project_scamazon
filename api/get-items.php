<?php
require_once(__DIR__.'/../globals.php');
$db = _api_db();
try{
    $query = $db->prepare('SELECT * FROM products');
    $query->execute();
    $data = $query->fetchAll();
    echo json_encode($data);
} catch(PDOException $ex){
    _res('500', ['info' => 'System under maintainance', 'error' => __LINE__]);
}