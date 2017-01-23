<?php

  require 'vendor/autoload.php';
  use OpenCloud\OpenStack;

  if(!isset($_GET['userid'])){
    echo "error_get_id";
    exit;
  }

  include("connect_status_script.php");

  $connection_status = connectDB();

  if(!$connection_status){
    echo "error_connection_status";
    exit;
  } else {

    $user_id = $_GET['userid'];
    $selectQuery = "SELECT firstname FROM ps_customer WHERE id_customer=".$user_id;
    $result = mysqli_query($connection_status, $selectQuery);
    $row = mysqli_fetch_row($result);

    if ($row[0]==""){
      echo "error_user_not_exist";
      exit;
    }

    $url_worker = "http://server_worker:8090/play/" . $user_id ;
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url_worker);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    curl_setopt($ch, CURLOPT_VERBOSE, TRUE);
    curl_setopt($ch, CURLOPT_CONNECTTIMEOUT,30);
    curl_setopt($ch, CURLOPT_TIMEOUT,30);
    $output = curl_exec($ch);
    curl_close($ch);

    if(!$output){
      echo "error_in_worker";
      exit;
    }

    $address_swift = file_get_contents("address.swift");
    $address_swift = trim(preg_replace('/\s\s+/', ' ', $address_swift));
    $authUrl = 'http://10.11.50.26:5000/v2.0';
  	$username = 'groupe7';
  	$password = 'dzCr8tliSyo='; // mot de passe Horizon
  	$tenant = 'project7';
    $swiftUrl = file_get_contents("address.swift");
  	$serviceName = 'swift';
  	$region = 'region1';

    $client = new OpenStack($authUrl, array(
      'username'=> $username,
      'password'=> $password,
      'tenantName'  => $tenant
    )
    );

    $client->authenticate();
    $service = $client->objectStoreService($serviceName, $region);
  	$container = $service->getContainer('test');

  	$container->uploadObject($user_id, $output);

    $updateStatusQuery = "INSERT INTO ps_played (id_customer, status) VALUES (".$user_id.", true)";
    $result = mysqli_query($connection_status, $updateStatusQuery);

    if (!$result) {

      $curl = curl_init("server_picture/".$user_id.".jpg");
      curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
      curl_setopt($curl, CURLOPT_HEADER, false);
      curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
      curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type: image/png'));

      echo "error_inserting_status";
      exit;

    } else {

      //SEND EMAIL WITH MAILGUN
      shell_exec ( "curl -s --user 'api:key-f94069c3ff1b0faae0527d532e6a3d57' \
      https://api.mailgun.net/v3/sandboxa37f743f990d4d989c69f315dc097fdb.mailgun.org/messages \
      -F from='Mailgun Sandbox <postmaster@sandboxa37f743f990d4d989c69f315dc097fdb.mailgun.org>' \
      -F to='Moreno <djlinux93@gmail.com>' \
      -F subject='Game Played' \
      -F text='User ".$user_id." played the game '" );

      echo "OK";
      exit;

    }

}



 ?>
