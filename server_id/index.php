<?php

	include("connect_id_script.php");

	if (!isset($_GET['userid'])){
		$arr = array('name' => 'error_code', 'surname' => 'error_code');
		echo json_encode($arr);
		exit;
	} else {
		$user_id = $_GET['userid'];
	}
	$namequery = "SELECT firstname, lastname FROM ps_customer WHERE id_customer =" . $user_id;

	$connection_id = connectDB();

	if(!$connection_id){

		 //echo "name=error_code;surname=error_code";
		 $arr = array('name' => 'error_code', 'surname' => 'error_code',);
		 echo json_encode($arr);
		 exit;

	} else {

		$result = mysqli_query($connection_id, $namequery);
		if (!$result) {
			$arr = array('name' => 'error_code', 'surname' => 'error_code',);
 		 	echo json_encode($arr);
			exit;
	  } else {
			$row = mysqli_fetch_row($result);

			 if($row[0]==""){
				 $arr = array('name' => 'not_found', 'surname' => 'not_found',);
				 echo json_encode($arr);
				 exit;
			 }else{
				 $arr = array('name' => $row[0], 'surname' => $row[1],);
				 echo json_encode($arr);
				 exit;
			 }
	  }
	}


?>
