<?php
  header('Access-Control-Allow-Origin: *');
  header('Access-Control-Allow-Methods: GET, POST');
  header("Access-Control-Allow-Headers: X-Requested-With");

  include_once "checkCredentials.php";

  function toBoolean($str) {
    return $str == "true";
  }
?>