<?php

  include("connect_status_script.php");

  $connection_status = connectDB();

  if(!$connection_status){

    $arr = array('status' => 'error_code',);
    echo json_encode($arr);
    exit;

  } else {


    $user_id = $_GET['userid'];
    $statusquery = "SELECT status FROM ps_played WHERE id_customer =" . $user_id;

    $result = mysqli_query($connection_status, $statusquery);

    if (!$result) {
      $arr = array('status' => 'error_code',);
      echo json_encode($arr);
      exit;
    } else {

  		$row = mysqli_fetch_row($result);
      if ($row[0]==""){

        $namequery = "SELECT firstname, lastname FROM ps_customer WHERE id_customer =" . $user_id;
        $result = mysqli_query($connection_status, $namequery);
        $row = mysqli_fetch_row($result);

        if($row[0]!=""){

          $arr = array('status' => 'not_played',);
          echo json_encode($arr);
          exit;

 			  }else{

          $arr = array('status' => 'not_found',);
          echo json_encode($arr);
          exit;

 			 }




      } else {

         if($row[0]==0){
           $arr = array('status' => 'not_played',);
           echo json_encode($arr);
           exit;
         } else {
           $arr = array('status' => 'played',);
           echo json_encode($arr);
           exit;
         }
      }
    }
  }
?>
