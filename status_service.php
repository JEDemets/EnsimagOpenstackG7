<?php

function get_status($connection_status, $user_id)
{
  //retrieve user status

  $statusquery = "SELECT status_played FROM users WHERE id =" . $user_id;

  $result = mysqli_query($connection_status, $statusquery);

  if (!$result) {
			//echo $statusquery;
			header("location: ./error_db_page.php");
  } else {
		$row = mysqli_fetch_row($result);
    if ($row[0]==""){
      header("location: ./error_not_exist.php");
      exit;
    }
    return $row[0];
  }

}

?>
