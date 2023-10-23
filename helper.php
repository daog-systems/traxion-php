<?php

require_once('otphp/lib/otphp.php');
function my_totp_now($secret_key) {
  $totp = new \OTPHP\TOTP($secret_key, array('interval' => 43200));
  $currentCode = $totp->now();
  return $currentCode;
}

require_once('gibberish-aes-php/GibberishAES.php');
function gibberish_aes_encrypt($string, $pass) {
  GibberishAES::size(256);
  $encrypted_string = GibberishAES::enc($string, $pass);
  return $encrypted_string;
}