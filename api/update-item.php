
   
<?php
require_once(__DIR__.'/../globals.php');
$db = _api_db();

// //Validate
if(!isset($_POST['title_en']) && !isset($_POST['title_da'])){ _res('400',[ "info" => "Product needs a title in both danish and english"]);}
if((strlen($_POST['title_en']) || strlen($_POST['title_da']) ) < _PRODUCT_MIN_LEN){ _res('400',[ "info" => "Title length must be at least "._PRODUCT_MIN_LEN." characters"]);}
if((strlen($_POST['title_en']) || strlen($_POST['title_da']) ) > _PRODUCT_MAX_LEN){ _res('400',[ "info" => "Title length can be no longer than "._PRODUCT_MAX_LEN." characters"]);}

if(!isset($_POST['price']) || $_POST['price'] == ''){ _res('400',[ "info" => "Product needs a price"]);}

if(!isset($_POST['description_en']) && !isset($_POST['description_da'])){ _res('400',[ "info" => "Product needs a description in both danish and english"]);}
if((strlen($_POST['description_da']) || strlen($_POST['description_da']) ) > _PRODUCT_MAX_LEN){ _res('400',[ "info" => "Title length can be no longer than "._DESCRIPTION_MAX_LEN." characters"]);}

if(!isset($_POST['id'])){_res('400', ['info' => 'No id']);}
if(strlen($_POST['id']) != 32){_res('400', ['info' => 'Not a valid id']);}
try{
    $q = $db->prepare('UPDATE products SET title_en = :title_en, title_da = :title_da, price = :price, description_en = :description_en, description_da = :description_da WHERE id = :id');
    $q->bindValue(':title_en', $_POST['title_en']);
    $q->bindValue(':title_da', $_POST['title_da']);
    $q->bindValue(':price', $_POST['price']);
    $q->bindValue(':description_en', $_POST['description_en']);
    $q->bindValue(':description_da', $_POST['description_da']);
    $q->bindValue(':id', $_POST['id']);
    $q->execute();
    _res('200', ["info" => "Succesfully updated", "data" => $_POST]);
}catch(Exception $ex){
    _res('500', ["info" => "System under maintainance".__LINE__]);
}