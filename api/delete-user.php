<?php
require_once(__DIR__.'/../globals.php');
$db = _api_db();
try{
    $id = $_GET['id'];
    // echo 'Deleted user with id: '. $id;
    $query = $db->prepare('DELETE FROM users WHERE id = :id');
    $query->bindValue(':id', $id);
    $query->execute();
    $response = ['info' => 'Deleted '.$query->rowCount().' user with id: '.$id];
    echo json_encode($response);

}catch(PDOException $ex){
    _res('500', ["info" => "System under maintainance".__LINE__]);
}