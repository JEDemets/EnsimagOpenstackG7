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
  var response_http = xmlHttp.responseText;
  alert(response_http);
  document.getElementById("button_home").disabled = false;
  if (response_http.toLowerCase().indexOf("error")>=0){
      location.href = "./error_playing.php";
  }else{
      location.reload(true);
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


    echo "<p align=center >Inserted id: " . $_GET['userid'] . "<p>";
    echo "<hr>";
    $user_id = $_GET['userid'];


    /* -------------------------------

    IDENTIFICATION service

    ------------------------------- */

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

    /* -------------------------------
    GET REQUEST IDENTIFICATION SERVICE
    ------------------------------- */
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $new_url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
    $output = curl_exec($ch);
    $arr = json_decode($output, true);
    curl_close($ch);


    if (empty($arr)){
      $_GET['name']="error_code";
      $_GET['surname']="error_code";
    } else {
      if ($arr['name']=="" || !isset($arr['name'])){
        $_GET['name']="error_code";
      } else {
        $_GET['name']=$arr['name'];
      }
      if ($arr['surname']=="" || !isset($arr['surname'])){
        $_GET['surname']="error_code";
      } else {
        $_GET['surname']=$arr['surname'];
      }
    }

    if ($_GET['name']=="error_code" && $_GET['surname'] == "error_code"){
      echo "<h3 align='center'>Le service [ID] ne marche pas pour l'instant, essayer plus tard </h3>";
    } else if ($_GET['name']=="not_found" && $_GET['surname'] == "not_found") {
      echo "<h3 align='center'>[ID] Utilisateur non trouvé<h3>";
    } else {
      echo "<h3 align='center'>[ID] - Welcome/Bienvenue/Benvenuto  " . $_GET['name'] . " " . $_GET['surname'] . "<h3>";
    }

    echo "<hr>";

    /* -------------------------------

    STATUS service

    ------------------------------- */

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

     /* -------------------------------
     GET REQUEST STATUS SERVICE
     ------------------------------- */

     $ch = curl_init();
     curl_setopt($ch, CURLOPT_URL, $new_url);
     curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
     curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
     $output = curl_exec($ch);
     $arr = json_decode($output, true);
     curl_close($ch);

     if (empty($arr)){
       $_GET['status']="error_code";
     } else {
       if ($arr['status']=="" || !isset($arr['status'])){
         $_GET['status']="error_code";
       } else {
         $_GET['status']=$arr['status'];
       }
     }

     if ($_GET['status']=="error_code"){
       echo "<h3 align='center'>Le service [STATUS] ne marche pas pour l'instant, essayer plus tard.</h3>";
     } else if ($_GET['status']=="not_found"){
       echo "<h3 align='center'>Le service [STATUS] n'a pas trouvé cette id.</h3>";
     } else if ($_GET['status']=="played") {
       echo "<h3 align='center'>[STATUS] Deja joué. </h3>";
     } else {
       echo "<div align=center><button onclick='playTheGame()' id='button_play' type='button' align=center>[STATUS] Get my Gift</button></div>";
     }

     echo "<hr>";

     /* -------------------------------

     PICTURE service

     ------------------------------- */

    if (isset($_GET['status']) && $_GET['status']=='played'){

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

       /* -------------------------------
       GET REQUEST PICTURE SERVICE
       ------------------------------- */

       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $new_url);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
       curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
       $output = curl_exec($ch);
       $arr = json_decode($output, true);
       curl_close($ch);

       if (empty($arr)){
         $_GET['picture']="error_code";
       } else {
         if ($arr['picture']=="" || !isset($arr['picture'])){
           $_GET['picture']="error_code";
         } else {
           $_GET['picture']=$arr['picture'];
         }
       }

       if($_GET['picture']!="error_code"){
         echo '<img src="data:image/gif;base64,' . $_GET['picture'] . '" />';
       } else {
         echo "<h3 align='center'>[PIC] Erreur dans la récupération de l'image</h3>";
       }


    } else if ( isset($_GET['status']) && ($_GET['status'] == 'not_played') )
      echo "<h3 align='center'>Jouer pour obtenir le cadeau</h3>";
    else
      echo "<h3 align='center'>[STATUS] Il faut s'identifier</h3>";

    echo "<hr>";

    /* -------------------------------
    PRINT HOME BUTTON
    ------------------------------- */
    if (isset($_GET['userid'])){
      echo "<div align=center><button onclick='returnHome()' id='button_home' type='button' align=center> HOME </button></div>";
      exit;
    }

}

?>

</body>

</html>
