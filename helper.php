<?php

function print_pre($text, $pre_text = '') {
  echo $pre_text;
  echo '<pre>';
  print_r($text);
  echo '</pre>';
}

require_once('otphp/lib/otphp.php');
class My_totp {

  function __construct() {
  }

  function now($secret_key) {
    $totp = new \OTPHP\TOTP($secret_key, array('interval' => 43200));
    $currentCode = $totp->now();
    return $currentCode;
  }

  function verify($secret_key, $otp) {
    $totp = new \OTPHP\TOTP($secret_key, array('interval' => 43200));
    return $totp->verify($otp);
  }

}

function my_totp_now($secret_key) {
  $totp = new My_totp();
  return $totp->now($secret_key);
}

require_once('gibberish-aes-php/GibberishAES.php');
class Gibberish_aes {

  function __construct() {

  }

  function encrypt($string, $pass) {
    // echo '<br />';

    // This is a secret pass-phrase, keep it in a safe place and don't loose it.
    // $pass = 'my secret pass-phrase, it should be long';
    // echo '$pass = '.$pass;
    // echo '<br />';
    // The string to be encrypted.
    // $string = 'my secret message';
    // echo '$string = '.$string;
    // echo '<br />';
    // echo '<br />';

    // The default key size is 256 bits.
    // $old_key_size = GibberishAES::size();

    // echo 'Encryption and decryption using a 256-bit key:';
    // echo '<br />';
    GibberishAES::size(256);
    // This is the result after encryption of the given string.
    $encrypted_string = GibberishAES::enc($string, $pass);
    // This is the result after decryption of the previously encrypted string.
    // $decrypted_string == $string (should be).
    // $decrypted_string = GibberishAES::dec($encrypted_string, $pass);
    // echo '$encrypted_string = '.$encrypted_string;
    // echo '<br />';
    // echo '$decrypted_string = '.$decrypted_string;
    // echo '<br />';
    // echo '<br />';

    // echo 'Encryption and decryption using a 192-bit key:';
    // echo '<br />';
    // GibberishAES::size(192);
    // $encrypted_string = GibberishAES::enc($string, $pass);
    // $decrypted_string = GibberishAES::dec($encrypted_string, $pass);
    // echo '$encrypted_string = '.$encrypted_string;
    // echo '<br />';
    // echo '$decrypted_string = '.$decrypted_string;
    // echo '<br />';
    // echo '<br />';
    //
    // echo 'Encryption and decryption using a 128-bit key:';
    // echo '<br />';
    // GibberishAES::size(128);
    // $encrypted_string = GibberishAES::enc($string, $pass);
    // $decrypted_string = GibberishAES::dec($encrypted_string, $pass);
    // echo '$encrypted_string = '.$encrypted_string;
    // echo '<br />';
    // echo '$decrypted_string = '.$decrypted_string;
    // echo '<br />';
    // echo '<br />';
    //
    // // Restore the old key size.
    // GibberishAES::size($old_key_size);
    return $encrypted_string;
  }

  function decrypt($encrypted_string, $pass) {
    // echo '<br />';

    // This is a secret pass-phrase, keep it in a safe place and don't loose it.
    // $pass = 'my secret pass-phrase, it should be long';
    // echo '$pass = '.$pass;
    // echo '<br />';
    // The string to be encrypted.
    // $string = 'my secret message';
    // echo '$string = '.$string;
    // echo '<br />';
    // echo '<br />';

    // The default key size is 256 bits.
    // $old_key_size = GibberishAES::size();

    // echo 'Encryption and decryption using a 256-bit key:';
    // echo '<br />';
    GibberishAES::size(256);
    // This is the result after encryption of the given string.
    // $encrypted_string = GibberishAES::enc($string, $pass);
    // This is the result after decryption of the previously encrypted string.
    // $decrypted_string == $string (should be).
    $decrypted_string = GibberishAES::dec($encrypted_string, $pass);
    // echo '$encrypted_string = '.$encrypted_string;
    // echo '<br />';
    // echo '$decrypted_string = '.$decrypted_string;
    // echo '<br />';
    // echo '<br />';

    // echo 'Encryption and decryption using a 192-bit key:';
    // echo '<br />';
    // GibberishAES::size(192);
    // $encrypted_string = GibberishAES::enc($string, $pass);
    // $decrypted_string = GibberishAES::dec($encrypted_string, $pass);
    // echo '$encrypted_string = '.$encrypted_string;
    // echo '<br />';
    // echo '$decrypted_string = '.$decrypted_string;
    // echo '<br />';
    // echo '<br />';
    //
    // echo 'Encryption and decryption using a 128-bit key:';
    // echo '<br />';
    // GibberishAES::size(128);
    // $encrypted_string = GibberishAES::enc($string, $pass);
    // $decrypted_string = GibberishAES::dec($encrypted_string, $pass);
    // echo '$encrypted_string = '.$encrypted_string;
    // echo '<br />';
    // echo '$decrypted_string = '.$decrypted_string;
    // echo '<br />';
    // echo '<br />';
    //
    // // Restore the old key size.
    // GibberishAES::size($old_key_size);
    return $decrypted_string;
  }
}

function gibberish_aes_encrypt($string, $pass) {
  $g = new Gibberish_aes();
  return $g->encrypt($string, $pass);
}