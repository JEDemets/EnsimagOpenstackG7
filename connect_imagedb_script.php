<?php

function connectImageDB(){
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "openstackgift";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
      //die("Connection failed: " . mysqli_connect_error());
      header("location: ./error_db_page.php");
  } else {
    //echo "Connessione al DB avvenuta correttamente\n\n";
    return $conn;
  }


}

?>
