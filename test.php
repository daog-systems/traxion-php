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
// $password = '';
$password = '';
$merchantCode = '';
$accountNumber = '';
$apiKey = ''; // Use this as password
$secretKey = '';

$traxion = new Traxion(true);
$traxion->init($url, $secretKey, true);

$r = $traxion->account_number($username, $password);
print_pre($r, '<span class="text-success">Output</span>');

$amount = 1;
$r = $traxion->qr_generate_merchant($username, $password, $amount);
$qr = $r->data->rawString;
print_pre($r, '<span class="text-success">Output</span>');

echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$qr&choe=UTF-8'><br>";

$r = $traxion->bank_transfer_qr_check($username, $password, $qr);
print_pre($r, '<span class="text-success">Output</span>');

$referenceNumber = '211000';
$r = $traxion->details_merchant_reference($username, $password, $referenceNumber);
print_pre($r, '<span class="text-success">Output</span>');