<?php

include("connect_imagedb_script.php");
include("connect_script.php");

$NUMBERGIFT = 3;

$id_gift = rand(1, $NUMBERGIFT);

$user_id = $_GET['userid'];

$connectionStatus = connectDB();

$selectQuery = "SELECT name FROM users WHERE id=".$user_id;

$result = mysqli_query($connectionStatus, $selectQuery);
$row = mysqli_fetch_row($result);

if ($row[0]==""){
  header("location: ./error_not_exist.php");
  exit;
}

$updateStatusQuery = "UPDATE users
SET status_played=true
WHERE id=" . $user_id;

$result = mysqli_query($connectionStatus, $updateStatusQuery);

if (!$result) {
    //echo $namequery;
    header("location: ./error_db_page.php");
} else {
  if (!mysqli_commit($connectionStatus)){
    header("location: ./error_db_page.php");
  }else {
    header("location: ./index.php?userid=".$user_id);
  }

}

$connectionImage = connectImageDB();

$insertGiftQuery = "INSERT INTO assigned_gift VALUES ($id_gift, \"".$user_id."\")";

$result = mysqli_query($connectionImage, $insertGiftQuery);

if (!$result) {
    //echo $namequery;
    header("location: ./error_db_page.php");
} else {
  if (!mysqli_commit($connectionImage)){
    header("location: ./error_db_page.php");
  }else {
    header("location: ./index.php?userid=".$user_id);
    exit;
  }

}



 ?>
