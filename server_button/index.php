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

    $authUrl = file_get_contents("auth.url");
    $authUrl = trim(preg_replace('/\s\s+/', ' ', $authUrl));
    //$authUrl = 'http://10.11.50.26:5000/v2.0';

    $username = file_get_contents("user.name");
    $username = trim(preg_replace('/\s\s+/', ' ', $username));
    //$username = 'groupe7';

    $password = file_get_contents("pwd");
    $password = trim(preg_replace('/\s\s+/', ' ', $password));
    //$password = 'dzCr8tliSyo=';

    $tenant = file_get_contents("tenant");
    $tenant = trim(preg_replace('/\s\s+/', ' ', $tenant));
    //$tenant = 'project7';

    $name_container = file_get_contents("container.name");
    $name_container = trim(preg_replace('/\s\s+/', ' ', $name_container));
    //$name_container = "test";

    //$swiftUrl = 'http://10.11.50.26:8080/v1/AUTH_2db62f6fa1664823bddbf1e03d35f0b4';
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
  	$container = $service->getContainer($name_container);

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
