<?php

	include("connect_id_script.php");

	$user_id = $_GET['userid'];
	$namequery = "SELECT name, surname FROM users WHERE id =" . $user_id;

	$connection_id = connectDB();

	if(!$connection_id){
		$new_url = $_SERVER['HTTP_REFERER'] . "?";
		$first = 0;
		foreach ($_GET as $key => $value) {
			if ($first==0){
				$new_url = $new_url . $key . "=" . $value;
				$first = 1;
			} else {
				$new_url = $new_url . "&" .  $key . "=" . $value;
			}
		 }

		 $new_url = $new_url . "&name=error_code&surname=error_code" ;
		 header("location: ".$new_url);
		 exit;
	} else {

		$result = mysqli_query($connection_id, $namequery);
		if (!$result) {
			$new_url = $_SERVER['HTTP_REFERER'] . "?";
			$first = 0;
			foreach ($_GET as $key => $value) {
				if ($first==0){
					$new_url = $new_url . $key . "=" . $value;
					$first = 1;
				} else {
					$new_url = $new_url . "&" .  $key . "=" . $value;
				}
			 }

			 $new_url = $new_url . "&name=error_code&surname=error_code";
			 header("location: ".$new_url);
			 exit;
				//echo "<h3 align='center'>Le service [ID] ne marche pas pour l'instant, essayer plus tard </h3>";
	  } else {
			$row = mysqli_fetch_row($result);
	    //echo "<h3 align='center'>[ID] - Welcome/Bienvenue/Benvenuto  " . $row[0] . " " . $row[1] . "<h3>";

			$new_url = $_SERVER['HTTP_REFERER'] . "?";
	    $first = 0;
	    foreach ($_GET as $key => $value) {
	      if ($first==0){
	        $new_url = $new_url . $key . "=" . $value;
	        $first = 1;
	      } else {
	        $new_url = $new_url . "&" .  $key . "=" . $value;
	      }
	     }

			 if($row[0]==""){
				 $new_url = $new_url . "&name=not_found&surname=not_found";
			 }else{
				 $new_url = $new_url . "&name=".$row[0]."&surname=".$row[1];
			 }

	     header("location: ".$new_url);
	     exit;
	  }
	}


?>
