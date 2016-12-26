<?php


if (isset($_GET['userid'])) {
  $user_id = $_GET['userid'];
  //echo $user_id;
}else{
    header('Location: ./index.php');
}

$con=mysqli_connect("vm-007.server.com","testuser","testpass","my_db");
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MariaDB: " . mysqli_connect_error();
  }

?>
