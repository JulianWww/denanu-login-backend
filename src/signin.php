<?php
  include "./dependancies/headers.php";

  function signin($data, $fileRoot) {
    $name = clean($_REQUEST["username"]);
    $userfile = $fileRoot . '/' . $name . '.json';

    if (!file_exists($userfile)) {
      print("{\"status\": \"fail\", \"reason\": \"uname missing\"}");
      die();
    }

    $json = json_decode(file_get_contents($userfile), true);

    if ($json["password"] === hash("sha512", $_REQUEST["password"])) {
      $token = genToken();
      $json["token"] = $token;
      file_put_contents($userfile, json_encode($json, JSON_PRETTY_PRINT));
      print("{\"status\": \"success\", \"data\": {\"token\": \"" . $token . "\", \"username\": \"" . $_REQUEST["username"] . "\"}}");
      return true;
    }
    return false;
  }

  signin($_REQUEST, "./data");
?>