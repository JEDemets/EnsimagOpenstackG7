<?php

function connectDB(){
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "openstack";

  // Create connection
  $conn = @mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  return $conn;

}

?>
