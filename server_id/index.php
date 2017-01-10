<?php

	include("connect_id_script.php");

	$user_id = $_GET['userid'];
	$namequery = "SELECT name, surname FROM users WHERE id =" . $user_id;

	$connection_id = connectDB();

	if(!$connection_id){
		header("location: server_main/index.php?userid?".$user_id."&name=error_code&surname=error_code");
	} else {

		$result = mysqli_query($connection_id, $namequery);
		if (!$result) {
				header("location: server_main/index.php?userid?".$user_id."&name=error_code&surname=error_code");
				//echo "<h3 align='center'>Le service [ID] ne marche pas pour l'instant, essayer plus tard </h3>";
	  } else {
			$row = mysqli_fetch_row($result);
	    //echo "<h3 align='center'>[ID] - Welcome/Bienvenue/Benvenuto  " . $row[0] . " " . $row[1] . "<h3>";
			header("location: server_main/index.php?userid?".$user_id."&name=".$row[0]."&surname?".$row[1]);
	  }
	}


?>
