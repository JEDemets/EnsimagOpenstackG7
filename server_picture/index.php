<?php

  $user_id = $_GET['userid'];
  $address_swift = file_get_contents("address.swift");
  $address_swift = trim(preg_replace('/\s\s+/', ' ', $address_swift));
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

  $arr = array('picture' => $image_answer,);
  echo json_encode($arr);
  exit;


?>
