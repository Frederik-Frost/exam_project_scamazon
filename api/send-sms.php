<?php

if(!isset($_POST['phone'])){ http_response_code(400); echo 'Phone number required';}
if(strlen($_POST['phone']) !== 8){ http_response_code(400); echo 'Phone number must be 8 numbers';}
if(!isset($_POST['sms'])){ http_response_code(400); echo 'Write an sms';}

$data = ['api_key' => 'd965794b-cab3-4fff-9af2-0aa2e169c904', 'to_phone' => $_POST['phone'], 'message' => $_POST['sms']];

$ch = curl_init("https://fatsms.com/send-sms");

curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
$response = curl_exec($ch);
curl_close($ch);

//$response is already JSON
echo $response;
