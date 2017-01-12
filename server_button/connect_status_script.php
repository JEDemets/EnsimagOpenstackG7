<?php

function connectDB(){
  $servername = "localhost"; //dbserver
  $username = "root";
  $password = ""; //groupe7
  $dbname = "openstack"; //db

  // Create connection
  $conn = @mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  return $conn;

}

?>
