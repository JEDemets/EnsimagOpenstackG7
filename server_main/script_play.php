<?php

$new_url = "http://server_button/index.php?";
$first = 0;

foreach ($_GET as $key => $value) {
  if ($first==0){
    $new_url = $new_url . $key . "=" . $value;
    $first = 1;
  } else {
    $new_url = $new_url . "&" .  $key . "=" . $value;
  }
 }

 $ch = curl_init();
 curl_setopt($ch, CURLOPT_URL, $new_url);
 curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
 curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
 $output = curl_exec($ch);

 curl_close($ch);


 echo $output;



?>
