<?php

function connectImageDB(){
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "openstackgift";

  // Create connection
  $conn = @mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  if (!$conn) {
      //header("location: ./error_db_page.php");
      echo "<h3 align='center'>Le query pour le service P ne marche pas pour l'instant, essayer plus tard </h3>";
  } else {
    //echo "Connessione al DB avvenuta correttamente\n\n";
    return $conn;
  }


}

?>
