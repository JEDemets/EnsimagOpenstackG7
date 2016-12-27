<?php

function display_button($connection_status, $status, $user_id)
{
  //NEED TO CHANGE FUNCTION EXECUTED BY BUTTON
  if ($status==0)
    echo "<div align=center><button onclick='sendHttpGet()' type='button' align=center>Get my Gift</button></div>";
	else {
	  echo "<div align=center><p>Cannot play Anymore.<p></div>";
	}
}

?>
