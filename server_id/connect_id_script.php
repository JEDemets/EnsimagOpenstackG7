<?php

function connectDB(){
  $servername = "dbserver"; //dbserver - localhost
  $username = "root";
  $password = "groupe7"; //groupe7 - ""
  $dbname = "db"; //db - test

  // Create connection
  $conn = @mysqli_connect($servername, $username, $password, $dbname);
  // Check connection
  return $conn;

}


?>
