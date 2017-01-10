<?php
include("connect_imagedb_script.php");

  //retrieve picture for user in DB and display it
  $conn = connectImageDB();

  if (!$conn){

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

     $new_url = $new_url . "&picture=error_code";

     header("location: ".$new_url);

    //echo "<h3 align='center'>Le service [P] ne marche pas pour l'instant, essayer plus tard </h3>";
  } else {

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

     $new_url = $new_url . "&picture=error_code";

     header("location: ".$new_url);

  }
