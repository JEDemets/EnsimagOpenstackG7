<?php

function connectImageDB(){
  $servername = "127.0.0.1";
  $username = "root";
  $password = "";
  $dbname = "openstackgift";

  // Create connection
  $conn = @mysqli_connect($servername, $username, $password, $dbname);
  
    return $conn;

}

?>
