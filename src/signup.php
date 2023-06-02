<?php
  include "./dependancies/headers.php";
  include "./dependancies/signature.php";

  function signup($data, $fileRoot, $backend_url) {
    $name = clean($_REQUEST["username"]);
    $userfile = $fileRoot . '/' . $name . '.json';
    
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

    $content = "Please confirm your E-mail by clicking the following link:\n" . $registerUrl;

    $mailCommand = "./dependancies/mail.sh 'Confirm Email' '" . $name . "' '" . $content . "'";
    shell_exec($mailCommand);

    print("{\"status\": \"success\"}");
  };

  signup($_REQUEST, "./data", "http://localhost:3000/register");
?>