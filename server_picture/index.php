<?php

    require 'vendor/autoload.php';
    use OpenCloud\OpenStack;


    $user_id = $_GET['userid'];
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

<<<<<<< Updated upstream
    $password = 'dzCr8tliSyo=';
    $tenant = 'project7';
    $swiftUrl = file_get_contents("address.swift");
=======
    $name_container = file_get_contents("container.name");
    $name_container = trim(preg_replace('/\s\s+/', ' ', $name_container));
    //$name_container = "test";

    //$swiftUrl = 'http://10.11.50.26:8080/v1/AUTH_2db62f6fa1664823bddbf1e03d35f0b4';
>>>>>>> Stashed changes
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
