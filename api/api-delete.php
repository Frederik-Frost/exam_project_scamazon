<?php
$db = require_once('./db.php');


try{
    $id = $_GET['id'];
    // echo 'Deleted user with id: '. $id;
    $query = $db->prepare('DELETE FROM users WHERE user_id = :id');
    $query->bindValue(':id', $id);
    $query->execute();
    $response = 'Deleted '.$query->rowCount().' user with id: '.$id;
    echo json_encode($response);

}catch(PDOException $ex){
    echo 'System under maintainance';
    exit();
}