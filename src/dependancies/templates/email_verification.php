<?php

  function genMailAutentication($service, $serviceURL, $authAddress, $unsubscribeURL) {
    $content = file_get_contents(__DIR__ . "/email_verification.html");
    $content = str_replace("SERVICE_NAME", $service, $content);
    $content = str_replace("SERVICE_URL", $serviceURL, $content);
    $content = str_replace("AUTH_ADRESS", $authAddress, $content);
    $content = str_replace("UNSUBSCRIBE", $unsubscribeURL, $content);
    return $content;
  }
?>