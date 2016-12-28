<!DOCTYPE html>
<html>
<head>
<title>Who are You</title>

<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="http://www.w3schools.com/lib/w3.css">

<script>

function verifyintjs(value){
  return (parseFloat(value) == parseInt(value)) && !isNaN(value);
}

function sendHttpGet() {
  userid = document.getElementById('userid').value;
  if (verifyintjs(userid) == ""){
    alert("Insert Valid User ID")
  } else {
    //substitute with service call the location
    location.href = location.href + "?userid=" + userid;
  }

}

function playTheGame(){
  user_id = getUrlVars()['userid'];
  location.href = "./assign_gift.php?userid=" + user_id;
}

function getUrlVars() {
  var vars = {};
  var parts = window.location.href.replace(/[?&]+([^=&]+)=([^&]*)/gi, function(m,key,value) {
    vars[key] = value;
  });
  return vars;
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
include("connect_script.php");


if(!isset($_GET['userid'])){
  echo "<div align=center>Insert your id: <input type='text' name='fname' id = 'userid' onkeydown = \"if (event.keyCode == 13)
            document.getElementById('sendbutton').click()\" ></div><br>";
  echo "<div align=center><button id='sendbutton' onclick='sendHttpGet()' type='button' align=center>I certify this is my UserID</button></div>";
} else {
  //RETRIEVE INFO FOR USER
  echo "<h4 align=center >Inserted id: " . $_GET['userid'] . "</h4>";
  echo "<hr>";
  //IDENTIFICATION service
  $user_id = $_GET['userid'];
  $connection_status = connectDB();
  identify($connection_status, $user_id);
  echo "<hr>";
  //STATUS service
  $status = get_status($connection_status, $user_id);
  //BUTTON service
  display_button($connection_status, $status, $user_id);
  echo "<hr>";
  //PICTURE service
  if($status == true){
    echo "<h3 align='center'>This is your gift: \r\n<h3>";
    display_picture($user_id);
  }else {
    echo "<h3 align='center'>Play your game to display your gift<h3>";
  }
  echo "<hr>";


}

?>

</body>

</html>
