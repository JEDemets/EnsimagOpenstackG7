<?php

include("connect_imagedb_script.php");
include("connect_script.php");

$NUMBERGIFT = 2;

$id_gift = rand(1, $NUMBERGIFT);

$user_id = $_GET['userid'];

$connectionStatus = connectDB();

if(!$connectionStatus){
  echo "<h3 align='center'>Le query pour le service [ID] n'a pas marche pour l'instant, essayer plus tard </h3>";
  exit;
}

mysqli_autocommit($connectionStatus, FALSE);

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
  //header("location: ./error_db_page.php");
  echo "<h3 align='center'>Le query pour le service P n'a pas marche pour l'instant, essayer plus tard </h3>";

}

$connectionImage = connectImageDB();


if (!$connectionImage){
  echo "<h3 align='center'>Le query pour le service P n'a pas marche pour l'instant, essayer plus tard </h3>";
  mysqli_rollback($connectionStatus);
  exit;
}

mysqli_autocommit($connectionImage, false);

$insertGiftQuery = "INSERT INTO assigned_gift VALUES ($id_gift, \"".$user_id."\")";

$result = mysqli_query($connectionImage, $insertGiftQuery);

if (!$result) {
    echo "Le query pour le service P n'a pas marche pour l'instant, essaie plus tard";
    mysqli_rollback($connectionStatus);
    exit;
    //header("location: ./error_db_page.php");
} else {
  if (!mysqli_commit($connectionImage)){
    echo "Le query pour le service P n'a pas marche pour l'instant, essaie plus tard ";
    mysqli_rollback($connectionStatus);
    exit;
    //header("location: ./error_db_page.php");
  }else {
    mysqli_commit($connectionStatus);
    header("location: ./index.php?userid=".$user_id);
    exit;
  }

}



 ?>
