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
  var second_part = location.href.split("?")[1];
  location.href = "server_worker/index.php?" + second_part;
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


if(!isset($_GET['userid'])){
  echo "<div align=center>Insert your id: <input type='text' name='fname' id = 'userid' onkeydown = \"if (event.keyCode == 13)
            document.getElementById('sendbutton').click()\" ></div><br>";
  echo "<div align=center><button id='sendbutton' onclick='sendHttpGet()' type='button' align=center>I certify this is my UserID</button></div>";
} else {

  //RETRIEVE INFO FOR USER
  echo "<p align=center >Inserted id: " . $_GET['userid'] . "<p>";
  echo "<hr>";
  //IDENTIFICATION service
  $user_id = $_GET['userid'];

  if (!isset($_GET('name'))){
    header("location: server_id/");
  } else {

    if ($_GET('name')=="error_code" && $_GET('surname') =="error_code"){
      echo "<h3 align='center'>Le service [ID] ne marche pas pour l'instant, essayer plus tard </h3>";
    } else {
      echo "<h3 align='center'>[ID] - Welcome/Bienvenue/Benvenuto  " . $_GET['name'] . " " . $_GET['surname'] . "<h3>";
    }

  }

  echo "<hr>";
  //STATUS service


  if (!isset($_GET('status'))){
    header("location: server_status/");
  } else {
    if ($_GET('status')=="error_code"){
      echo "<h3 align='center'>Le service [STATUS] ne marche pas pour l'instant, essayer plus tard.</h3>";
    } else if ($_GET('status')=="not_found"){
      echo "<h3 align='center'>Le service [STATUS] n'a pas trouvé cette id.</h3>";
    } else if ($_GET('status')=="played") {
      echo "<h3 align='center'>[STATUS] Deja joué. </h3>";
    } else {
      echo "<div align=center><button onclick='playTheGame()' type='button' align=center>[STATUS] Get my Gift</button></div>";
    }
  }
  echo "<hr>";


  //PICTURE service
  if($_GET['picture']=="error_code"){
    echo "<h3 align='center'>Le service [PIC] ne marche pas pour l'instant, essayer plus tard </h3>";
  }else {
    if($status == true){
      echo "<h3 align='center'>This is your gift: \r\n<h3>";
      display_picture($user_id);
    }else if ($status == false) {
      echo "<h3 align='center'>Play your game to display your gift<h3>";
    }
  }

  echo "<hr>";


}

?>

</body>

</html>
