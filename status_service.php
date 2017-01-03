<?php

function get_status($connection_status, $user_id)
{
  //retrieve user status

  if(!$connection_status){
    //header("location: ./error_db_page.php");
    echo "<h3 align='center'>Le service [ID] ne marche pas pour l'instant, essayer plus tard </h3>";
  } else {
    $statusquery = "SELECT status_played FROM users WHERE id =" . $user_id;

    $result = mysqli_query($connection_status, $statusquery);

    if (!$result) {
  			//header("location: ./error_db_page.php");
        echo "<h3 align='center'>Le service [ID] ne marche pas pour l'instant, essayer plus tard </h3>";
    } else {
  		$row = mysqli_fetch_row($result);
      if ($row[0]==""){
        header("location: ./error_not_exist.php");
        exit;
      }
      display_button($connection_status, $row[0], $user_id);
      return $row[0];
    }
  }

}

function display_button($connection_status, $status, $user_id)
{
  //NEED TO CHANGE FUNCTION EXECUTED BY BUTTON
  if ($status==0)
    echo "<div align=center><button onclick='playTheGame()' type='button' align=center>[STATUS] Get my Gift</button></div>";
	else {
	  echo "<div align=center><p>[STATUS] Cannot play Anymore.<p></div>";
	}
}
?>
