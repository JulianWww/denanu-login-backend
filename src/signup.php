<?php
  include_once "dependancies/headers.php";
  include_once "dependancies/signature.php";
  include_once "dependancies/mail.php";

  function signup($data, $fileRoot, $backend_url, $senderName, $senderMail, $apiKey, $serviceName, $serviceUrl, $unsubscribeUrl) {
    $name = clean($_REQUEST["username"]);
    $userfile = $fileRoot . '/login/' . $name . '.json';
    
    if (file_exists($userfile)) {
      print("{\"status\": \"fail\", \"reason\": \"uname Exists\"}");
      die();
    }

    $pswrd = hash("sha512", $_REQUEST["password"]);
    $mail = $_REQUEST["mail"];
    $sendMail = $_REQUEST["sendmail"];
    $remember = $_REQUEST["remember"];

    $data = $name . "/" . $pswrd . "/" . $mail . "/" . $sendMail;
    $sign = sign($data, $fileRoot);
    $registerUrl = $backend_url . "?username=" . $name . "&mail=" . $mail . "&password=" . $pswrd . "&sendmail=" . $sendMail . "&remember=" . $remember . "&signature=" . $sign;

    
    sendMail($name, $mail, $senderName, $senderMail, $apiKey,
      genMailAutentication($serviceName, $serviceUrl, $registerUrl, $unsubscribeUrl),
      "E-Mail Authentication"
    );

    print("{\"status\": \"success\"}");
  };
?>
