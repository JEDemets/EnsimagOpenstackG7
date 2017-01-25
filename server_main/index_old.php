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
    location.href = location.href.split("?")[0] + "?userid=" + userid;
  }

}

function playTheGame(){
	document.getElementById("button_play").disabled = true;
  	document.getElementById("button_home").disabled = true;
	var firstpart = location.href.split("index.php")[0];
  var second_part = location.href.split("?")[1];
  var xmlHttp = new XMLHttpRequest();
  xmlHttp.open( "GET", firstpart + "/script_play.php?" + second_part, false ); //false for synchronous request
  xmlHttp.send( null );
  alert(xmlHttp.responseText);
	document.getElementById("button_home").disabled = false;
  if (xmlHttp.responseText.includes("error")){
    location.href = "./error_playing.php";
  }else {
	location.href = "./index.php";
  }
}

function returnHome() {
    location.href = "./index.php";
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

<noscript>Something will not work without Javascript activated</noscript>
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

  if (!isset($_GET['name'])){
    $new_url = "http://server_id/index.php?";
    $first = 0;

    foreach ($_GET as $key => $value) {
      if ($first==0){
        $new_url = $new_url . $key . "=" . $value;
        $first = 1;
      } else {
        $new_url = $new_url . "&" .  $key . "=" . $value;
      }
     }


     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $new_url);
     //curl_setopt($ch, CURLOPT_HEADER, TRUE);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
     curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
     $output = curl_exec($ch);
     $arr = json_decode($output, true);

     curl_close($ch);

     $new_url = $_SERVER['PHP_SELF'] . "?";

     foreach ($_GET as $key => $value) {
       if ($first==0){
         $new_url = $new_url . $key . "=" . $value;
         $first = 1;
       } else {
         $new_url = $new_url . "&" .  $key . "=" . $value;
       }
      }


      if (empty($arr)){
        $new_url = $new_url . "&name=error_code&surname=error_code";
      }else {
        foreach ($arr as $key => $value) {
          if ($first==0){
            $new_url = $new_url . $key . "=" . $value;
            $first = 1;
          } else {
            $new_url = $new_url . "&" .  $key . "=" . $value;
          }
        }
      }

       header("Location: " . $new_url);

       exit;

  } else {

    if ($_GET['name']=="error_code" && $_GET['surname'] == "error_code"){
      echo "<h3 align='center'>Le service [ID] ne marche pas pour l'instant, essayer plus tard </h3>";
    } else if ($_GET['name']=="not_found" && $_GET['surname'] == "not_found") {
      echo "<h3 align='center'>[ID] Utilisateur non trouvé<h3>";
    } else {
      echo "<h3 align='center'>[ID] - Welcome/Bienvenue/Benvenuto  " . $_GET['name'] . " " . $_GET['surname'] . "<h3>";
    }

  }

  echo "<hr>";
  //STATUS service


  if (!isset($_GET['status'])){

    $new_url = "http://server_status/index.php?";
    $first = 0;

    foreach ($_GET as $key => $value) {
      if ($first==0){
        $new_url = $new_url . $key . "=" . $value;
        $first = 1;
      } else {
        $new_url = $new_url . "&" .  $key . "=" . $value;
      }
     }


     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $new_url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
     curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
     $output = curl_exec($ch);
     $arr = json_decode($output, true);

     curl_close($ch);

     $new_url = $_SERVER['PHP_SELF'] . "?";
	$first = 0;
     foreach ($_GET as $key => $value) {
       if ($first==0){
         $new_url = $new_url . $key . "=" . $value;
         $first = 1;
       } else {
         $new_url = $new_url . "&" .  $key . "=" . $value;
       }
      }


      if (empty($arr)){
        $new_url = $new_url . "&status=error_code";
      } else {
        foreach ($arr as $key => $value) {
          if ($first==0){
            $new_url = $new_url . $key . "=" . $value;
            $first = 1;
          } else {
            $new_url = $new_url . "&" .  $key . "=" . $value;
          }
         }
      }

       header("Location: " . $new_url);

     exit;

  } else {
    if ($_GET['status']=="error_code"){
      echo "<h3 align='center'>Le service [STATUS] ne marche pas pour l'instant, essayer plus tard.</h3>";
    } else if ($_GET['status']=="not_found"){
      echo "<h3 align='center'>Le service [STATUS] n'a pas trouvé cette id.</h3>";
    } else if ($_GET['status']=="played") {
      echo "<h3 align='center'>[STATUS] Deja joué. </h3>";
    } else {
      echo "<div align=center><button onclick='playTheGame()' id='button_play' type='button' align=center>[STATUS] Get my Gift</button></div>";
    }
  }
  echo "<hr>";


  if (isset($_GET['status']) && $_GET['status']=='played' && !isset($_GET['picture'])){

    $new_url = "http://server_picture/index.php?";
    $first = 0;

    foreach ($_GET as $key => $value) {
      if ($first==0){
        $new_url = $new_url . $key . "=" . $value;
        $first = 1;
      } else {
        $new_url = $new_url . "&" .  $key . "=" . $value;
      }
     }

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $new_url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
     curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
     $output = curl_exec($ch);
     $arr = json_decode($output, true);

	//$data =  base64_decode($arr['picture']);

	echo '<img src="data:image/gif;base64,' . $arr['picture'] . '" />';

	exit;
     curl_close($ch);

     $new_url = $_SERVER['PHP_SELF'] . "?";

     foreach ($_GET as $key => $value) {
       if ($first==0){
         $new_url = $new_url . $key . "=" . $value;
         $first = 1;
       } else {
         $new_url = $new_url . "&" .  $key . "=" . $value;
       }
      }

      if (empty($arr)){
        $new_url = $new_url . "&picture=error_code";
      } else {
        foreach ($arr as $key => $value) {
          if ($first==0){
            $new_url = $new_url . $key . "=" . $value;
            $first = 1;
          } else {
            $new_url = $new_url . "&" .  $key . "=" . $value;
          }
         }
      }

       header("Location: " . $new_url);

     exit;


  } else if (isset($_GET['status']) && $_GET['status']=='played' && isset($_GET['picture'])){

    if ($_GET['picture']=="error_code"){
      echo "<h3 align='center'>[PIC] Erreur dans la récupération de l'image</h3>";
    } else {
      $json_image = $_GET['picture'];
      $image = base64_decode($json_image);
      echo $image;
    }


  } else if ( isset($_GET['status']) && ($_GET['status'] == 'not_played') )
    echo "<h3 align='center'>Jouer pour obtenir le cadeau</h3>";
  else
    echo "<h3 align='center'>[STATUS] Il faut s'identifier</h3>";

  echo "<hr>";

  if (isset($_GET)){
    echo "<div align=center><button onclick='returnHome()' id='button_home' type='button' align=center> HOME </button></div>";
    exit;
  }

}



?>

</body>

</html>
