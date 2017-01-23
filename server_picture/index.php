<?php

    require 'vendor/autoload.php';
    use OpenCloud\OpenStack;


    $user_id = $_GET['userid'];
    $address_swift = file_get_contents("address.swift");
    $address_swift = trim(preg_replace('/\s\s+/', ' ', $address_swift));

    $authUrl = 'http://10.11.50.26:5000/v2.0';
    $username = 'groupe7';

    /*

    $password = file_get_contents("password.swift");
    $password = trim(preg_replace('/\s\s+/', ' ', $password));

    */

    $password = 'dzCr8tliSyo=';
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

    /*

    $name_container = file_get_contents("namecontainer.swift");
    $name_container = trim(preg_replace('/\s\s+/', ' ', $name_container));

    */

    $name_container = "test";
    $container = $service->getContainer($name_container);
    $object = $container->getObject($user_id);
    $response = $object->getContent();
    $response->rewind();

    $array = json_decode($response, true);

    if (!is_array($array)) {
      $image_answer = "internal_error";
    } else {
      $image_answer = $array['img'];
    }

    $arr = array('picture' => $image_answer,);
    echo json_encode($arr);
    exit;


?>
