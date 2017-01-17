<?php

if(!isset($_GET['userid'])){
  $new_url = $_SERVER['HTTP_REFERER'];
  header("location: " . $new_url . "/error_db_page.php");
  exit;
}

include("connect_status_script.php");

$connection_status = connectDB();

if(!$connection_status){
  $new_url = $_SERVER['HTTP_REFERER'];
  header("location: " . $new_url . "/error_db_page.php");
  exit;
  //echo "<h3 align='center'>Le service [ID] ne marche pas pour l'instant, essayer plus tard </h3>";
} else {

  //INTERFACE Worker
  $user_id = $_GET['userid'];

  $selectQuery = "SELECT name FROM users WHERE id=".$user_id;

  $result = mysqli_query($connection_status, $selectQuery);
  $row = mysqli_fetch_row($result);

  if ($row[0]==""){
    $new_url = $_SERVER['HTTP_REFERER'];
    header("location: " . $new_url . "/error_not_exist.php");
    exit;
  }

  $answer = file_get_contents("server_worker/play".$user_id);
  $image_array = json_decode($answer);

  /*
  img: base64 json image
  price: name of the price
  */

  $image = base64_decode($image_array['img']);

  $curl = curl_init("server_picture/".$user_id.".jpg");
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: image/png'));

  // Make the REST call, returning the result
  $response = curl_exec($curl);
  if (!$response) {
    $new_url = $_SERVER['HTTP_REFERER'];
    header("location: " . $new_url . "/error_dbimage_page.php");
  }


  $updateStatusQuery = "UPDATE users
  SET status_played=true
  WHERE id=" . $user_id;


  $result = mysqli_query($connection_status, $updateStatusQuery);

  if (!$result) {

    $curl = curl_init("server_picture/".$user_id.".jpg");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: image/png'));

    $new_url = $_SERVER['HTTP_REFERER'];
    header("location: " . $new_url . "/error_db_page.php");

    exit;
  }



}



 ?>
