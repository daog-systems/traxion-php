<?php

require_once('helper.php');
require_once('Traxion.php');

$url = 'https://sitapi2.traxionpay.com';
$username = '';
$password = '';
$secret_key = '';

$traxion = new Traxion(true);
$traxion->init($url, $secret_key, true);

$r = $traxion->account_number($username, $password);
print_pre($r);
