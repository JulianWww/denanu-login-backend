<?php
  include_once "dependancies/headers.php";

  function signin($data, $fileRoot) {
    if(!isset($creds["username"]) || !isset($creds["password"])) {
      http_response_code(403);
      print("{\"status\": \"fail\", \"reason\": \"missing data\"}");
      return false;
    }

    $name = clean($_REQUEST["username"]);
    $userfile = $fileRoot . '/login/' . $name . '.json';

    if (!file_exists($userfile)) {
      http_response_code(403);
      print("{\"status\": \"fail\", \"reason\": \"uname unknown\"}");
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

    http_response_code(403);
    print("{\"status\": \"fail\", \"reason\": \"auth failed\"}");
    return false;
  }

  # signin($_REQUEST, "./data");
?>
