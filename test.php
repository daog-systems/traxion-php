<style>
  .text-danger {
    color: #dc3545;
  }
  .text-info {
    color: #17a2b8;
  }
  .text-success {
    color: #28a745;
  }
</style>
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

$amount = 1;
$r = $traxion->qr_generate_merchant($username, $password, $amount);
$qr = $r->data->rawString;
print_pre($r);

echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$qr&choe=UTF-8'><br>";

$r = $traxion->bank_transfer_qr_check($username, $password, $qr);
print_pre($r);