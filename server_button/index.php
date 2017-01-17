<?php

if(!isset($_GET['userid'])){
  header("location: ../server_main/error_db_page.php");
  exit;
}

include("connect_status_script.php");

$connection_status = connectDB();

if(!$connection_status){
  header("location: ../server_main/error_db_page.php");
  exit;
  //echo "<h3 align='center'>Le service [ID] ne marche pas pour l'instant, essayer plus tard </h3>";
} else {

  //INTERFACE Worker
  $user_id = $_GET['userid'];

  $selectQuery = "SELECT firstname FROM ps_customer WHERE id_customer=".$user_id;

  $result = mysqli_query($connection_status, $selectQuery);
  $row = mysqli_fetch_row($result);

  if ($row[0]==""){
    header("location: ../server_main/error_not_exist.php");
    exit;
  }

  $answer = file_get_contents("server_worker/play".$user_id);
  /*
  img: base64 json image
  price: name of the price
  */
  //$image_array = json_decode($answer);
  //$image = base64_decode($image_array['img']);

  $curl = curl_init("server_picture/".$user_id.".jpg");
  curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "PUT");
  curl_setopt($curl, CURLOPT_HEADER, false);
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
  curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($answer));

  // Make the REST call, returning the result
  $response = curl_exec($curl);
  if (!$response) {
      header("location: ../server_main/error_dbimage_page.php");
  }


  $updateStatusQuery = "UPDATE ps_customer
  SET show_public_prices=true
  WHERE id_customer=" . $user_id;


  $result = mysqli_query($connection_status, $updateStatusQuery);

  if (!$result) {

    $curl = curl_init("server_picture/".$user_id.".jpg");
    curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
    curl_setopt($curl, CURLOPT_HEADER, false);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: image/png'));

    header("location: ../server_main/error_db_page.php");
    exit;
  }



}



 ?>
