
<?php
  function getPrivate($fileRoot) {
    //create new private and public key
    if (!file_exists($fileRoot . '/private_key.pem')) {
      $new_key_pair = openssl_pkey_new(array(
        "private_key_bits" => 2048,
        "private_key_type" => OPENSSL_KEYTYPE_RSA,
      ));
      openssl_pkey_export($new_key_pair, $private_key_pem);

      $details = openssl_pkey_get_details($new_key_pair);
      $public_key_pem = $details['key'];  

      //save for later
      file_put_contents($fileRoot . '/private_key.pem', $private_key_pem);
      file_put_contents($fileRoot . '/public_key.pem', $public_key_pem);
      return $private_key_pem;
    }
    else {
      return file_get_contents($fileRoot . '/private_key.pem');
    }
  }

  function sign($data, $fileRoot) {
    $private_key_pem = getPrivate($fileRoot);
    openssl_sign($data, $signature, $private_key_pem, OPENSSL_ALGO_SHA256);
    return bin2hex($signature);
  }

  function verify($data, $signature, $fileRoot) {
    $pubkeyid = file_get_contents($fileRoot . '/public_key.pem');
    return openssl_verify($data, hex2bin($signature), $pubkeyid, OPENSSL_ALGO_SHA256);
  }
?>
