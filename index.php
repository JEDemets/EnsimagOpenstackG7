<!DOCTYPE html>
<html>
<head>
<title>Who are You</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

<script>

function sendHttpGet() {
  userid = document.getElementById('userid').value;
  if (userid == ""){
    alert("Insert Valid Username")
  } else {
    //substitute with service call the location
    location.href = "/id_service/receive_id.php" + "?userid=" + userid;
  }

}

</script>

</head>

<body>

<header class="w3-container w3-blue" align=center>
  <h1>Play your Game</h1>
</header>
<br><br>
<?php

include("identification_service.php");
include("status_service.php");
include("button_service.php");
include("picture_service.php");


if(!isset($_GET['userid'])){
  echo "<div align=center>Insert your id: <input type='text' name='fname' id = 'userid'></div><br>";
  echo "<div align=center><button onclick='sendHttpGet()' type='button' align=center>I'm Lucky!</button></div>";
} else {
  //RETRIEVE INFO FOR USER
  echo "<h2 align=center >Welcome/Bienvenue/Benvenuto User: " . $_GET['userid'] . "</h2>";
  //IDENTIFICATION service
  $user_id = $_GET['userid'];
  identify(user_id);
  //STATUS service
  //BUTTON service
  //PICTURE service


}

?>

</body>

</html>
