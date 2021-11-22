<?php
// DELETE MULTIPLE PRODUCTS     
require_once(__DIR__.'/../globals.php');
$db = _api_db();
try{
    //Begin transaction if 2 or more updates, deletes, inserts
    $db->beginTransaction();
    foreach ($_POST['delete_item'] as $itemId)
    {
        //Validate the id to see if the sent id is a valid id
        if(!isset($itemId)){_res('400', ['info' => 'No id']);}
        if(strlen($itemId) != 32){_res('400', ['info' => 'Not a valid id']);}

        try{
            $q = $db->prepare('SELECT id FROM products WHERE id = :id');
            $q->bindValue(':id', $itemId);
            $q->execute();
            $row = $q->fetch();
            if(!$row){
                $db->rollBack();
                _res('400', ["info" => "No item with this id"]);
                exit();
            } else{
                try{
                    $q = $db->prepare('DELETE FROM products WHERE id = :id');
                    $q->bindValue(':id', $itemId);
                    $q->execute();
                } catch(Exception $ex){
                    $db->rollBack();
                    _res('500', ["info" => "System under maintainance".__LINE__]);
                }
            }
        } catch(Exception $ex){
            $db->rollBack();
            _res('500', ["info" => "System under maintainance".__LINE__]);
        }
    };
    //Commit
    $db->commit();
    _res('200', ["info" => "Deleted ".count($_POST['delete_item'])." Items"]);
} catch(Exception $ex){
    $db->rollBack();
    _res('500', ["info" => "System under maintainance".__LINE__]);
}