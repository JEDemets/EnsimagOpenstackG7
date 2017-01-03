<?php

function identify($connection_status, $user_id)
{
	//identify the user associated to user_id
	$namequery = "SELECT name, surname FROM users WHERE id =" . $user_id;

	if(!$connection_status){
		echo "<h3 align='center'>Le service [ID] ne marche pas pour l'instant, essayer plus tard </h3>";
	} else {
		$result = mysqli_query($connection_status, $namequery);

		if (!$result) {
				//header("location: ./error_db_page.php");
				echo "<h3 align='center'>Le service [ID] ne marche pas pour l'instant, essayer plus tard </h3>";
	  } else {
	    //echo "Connessione al DB avvenuta correttamente\n\n";
			$row = mysqli_fetch_row($result);
	    echo "<h3 align='center'>[ID] - Welcome/Bienvenue/Benvenuto  " . $row[0] . " " . $row[1] . "<h3>";
	  }
	}


}

?>
