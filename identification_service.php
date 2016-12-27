<?php

function identify($connection_status, $user_id)
{
	//identify the user associated to user_id
	$namequery = "SELECT name, surname FROM users WHERE id =" . $user_id;

	$result = mysqli_query($connection_status, $namequery);

	if (!$result) {
			//echo $namequery;
			header("location: ./error_db_page.php");
  } else {
    //echo "Connessione al DB avvenuta correttamente\n\n";
		$row = mysqli_fetch_row($result);
    echo "<h3 align='center'>[IDENTIFICATION SERVICE] - Welcome/Bienvenue/Benvenuto  " . $row[0] . " " . $row[1] . "<h3>";
  }

}

?>
