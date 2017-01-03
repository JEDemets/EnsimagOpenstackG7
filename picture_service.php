<?php
include("connect_imagedb_script.php");

function display_picture($user_id)
{
  //retrieve picture for user in DB and display it
  $conn = connectImageDB();

  if (!$conn){
    //header("location: ./error_db_page.php");
    echo "<h3 align='center'>Le service P ne marche pas pour l'instant, essayer plus tard </h3>";
  } else {

    $idimagequery = "SELECT image_id FROM assigned_gift WHERE user_id =" . $user_id;

    $result = mysqli_query($conn, $idimagequery);

  	if (!$result) {
  			//header("location: ./error_db_page.php");
        echo "<h3 align='center'>Le service P ne marche pas pour l'instant, essayer plus tard </h3>";

    } else {
  		$row = mysqli_fetch_row($result);
      $id_image = $row[0];

      $pathquery = "SELECT path_image FROM images WHERE id =" . $id_image;
      $result = mysqli_query($conn, $pathquery);

      if (!$result) {
    		//header("location: ./error_db_page.php");
        echo "<h3 align='center'>Le service P ne marche pas pour l'instant, essayer plus tard </h3>";
      } else {
    		$row = mysqli_fetch_row($result);
        echo "<div align='center' ><img src=" . $row[0] . "' alt='error'> </div>";
      }
  }


  }


}

?>
