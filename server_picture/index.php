<?php

$user_id = $_GET['userid'];
$address_swift = file_get_contents("address.swift");
$curl = curl_init($address_swift."/".$user_id.".jpg");
curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "GET");
curl_setopt($curl, CURLOPT_HEADER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: image/png'));

$response = curl_exec($curl);
if (!$response) {
    $image_answer = "error_code";
} else {
  $image_array = json_decode($reponse);
  $image_answer = $image_array['img'];
}

$new_url = $_SERVER['HTTP_REFERER'] . "?";
$first = 0;
foreach ($_GET as $key => $value) {
  if ($first==0){
    $new_url = $new_url . $key . "=" . $value;
    $first = 1;
  } else {
    $new_url = $new_url . "&" .  $key . "=" . $value;
  }
 }

 $new_url = $new_url . "&" .  "picture" . "=" . $image_answer;
 header("location: ".$new_url);
 exit;

?>
