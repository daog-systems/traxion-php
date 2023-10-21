<?php

require_once('helper.php');
require_once('Traxion.php');

$url = 'https://sitapi2.traxionpay.com';
$username = '';
$password = '';
$secret_key = '';

$traxion = new Traxion();
$traxion->init($url, $secret_key);

$r = $traxion->login_thirdparty($username, $password);
