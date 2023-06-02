<?php
  include "./dependancies/headers.php";
  include "./dependancies/signature.php";

  function register($data, $fileRoot) {
    $name = clean($_REQUEST["username"]);
    $pswrd = clean($_REQUEST["password"]);
    $userfile = $fileRoot . '/' . $name . '.json';
    
    if (file_exists($userfile)) {
      print("{\"status\": \"fail\", \"reason\": \"uname Exists\"}");
      die();
    }

    $mail = $_REQUEST["mail"];
    $sendMail = $_REQUEST["sendmail"];
    $remember = $_REQUEST["remember"];

    $data = $name . "/" . $pswrd . "/" . $mail . "/" . $sendMail;

    if (verify($data, $_REQUEST["signature"], $fileRoot) === 0) {
      print("{\"status\": \"fail\", \"reason\": \"signature failed\"}");
      die();
    }

    $json = array();
    $json["password"] = $pswrd;
    $json["email"] = $mail;
    $json["sendmail"] = toBoolean($sendMail);

    $token = genToken();
    $json["token"] = $token;

    file_put_contents($userfile, json_encode($json, JSON_PRETTY_PRINT));

    print("{\"status\": \"success\", \"data\": {\"token\": \"" . $token . "\", \"username\": \"" . $_REQUEST["username"] . "\"}}");
  };

  register($_REQUEST, "./data");
?>