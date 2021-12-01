<?php
// $data = file_get_contents('https://docs.google.com/spreadsheets/d/e/2PACX-1vTCDPj2fyL9KLftpAQ24t-daZa43Kg-jAyMns6QYdAa0_VluOIesJ8KVtOOO7s7tyae_DPEqbh9vcfF/pub?output=tsv'); // My own
$data = file_get_contents('https://docs.google.com/spreadsheets/d/e/2PACX-1vSsJnnqeL6tveW1leHCEFTuwDPWzc58MXbnsFo7ybO2q_Yj8sQExJ7213J0URwKucyQDohNDSlQam9X/pub?output=tsv');
// Break lines
$lines = explode("\n", $data);
$keys = explode("\t", $lines[0]);
$out = [];
for($i = 1; $i < count($lines); $i++){
  $data = explode("\t", $lines[$i]);
  $item = [];
  for($j = 0; $j < count($data); $j++){
    $data[$j] = str_replace("\r", "", $data[$j]);
    $keys[$j] = str_replace("\r", "", $keys[$j]);
    $item[$keys[$j]]=$data[$j];
  }
  array_push($out, $item);
}
file_put_contents("shop.txt", json_encode($out));
header('Content-Type: application/json');
echo json_encode($out);