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
$apiKey = ''; // Use this as password
// $password = '';
$password = $apiKey;
$merchantCode = '';
$accountNumber = '';
$secretKey = '';

$traxion = new Traxion();
$traxion->init($url, $secretKey, true);

// $r = $traxion->account_number($username, $password);
// print_r($r, '<span class="text-success">Output</span>');

$r = $traxion->wallet($username, $password);
print_r($r);

// $batchIdentifier = "batch-may-2-1";
// $institutionID = 37225; // TODO: Where to get these?
// $accountNumber = "09267912280";
// $merchantReferenceNumber = "09267912280";
// $amount = 100;
// $recipientName = "Floyd Matabilas";
// $mobileNumber = "09267912280";
// $tag = 1;
// $notifyRecipient = 1;
// $purpose = 1;
// $message = 'This is a test transaction';
// $r = $traxion->funds_transfer_bulk($username, $password, $batchIdentifier, $institutionID, $accountNumber, $merchantReferenceNumber, $amount, $recipientName, $mobileNumber, $tag, $notifyRecipient, $purpose, $message);
// print_r($r, '<span class="text-success">Output</span>');

// $amount = 10;
// $r = $traxion->qr_generate($username, $password, $amount);
// print_r($r, '<span class="text-success">Output</span>');

// $amount = 10;
// $r = $traxion->qr_generate_merchant($username, $password, $amount);
// $qr = $r->data->rawString;
// print_r($r, '<span class="text-success">Output</span>');
// echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$qr&choe=UTF-8'><br>";

// $r = $traxion->bank_transfer_qr_check($username, $password, $qr);
// print_r($r, '<span class="text-success">Output</span>');

// $merchantReferenceNumber = ''; // TODO: Where to get this?
// $amount = 10;
// $description = '';
// $r = $traxion->bank_transfer_qr($username, $password, $qr, $merchantReferenceNumber, $amount, $description);
// print_r($r, '<span class="text-success">Output</span>');

// $referenceNumber = '211000'; // TODO: Where to get this?
// $r = $traxion->details_merchant_reference($username, $password, $referenceNumber);
// print_r($r, '<span class="text-success">Output</span>');

// $referenceNumber = '211000'; // TODO: Where to get this?
// $r = $traxion->details_aggregator($username, $password, $referenceNumber);
// print_r($r, '<span class="text-success">Output</span>');

// $referenceNumber = '211000'; // TODO: Where to get this?
// $r = $traxion->details_batch($username, $password, $referenceNumber);
// print_r($r, '<span class="text-success">Output</span>');

// $r = $traxion->payment_categories($username, $password);
// print_r($r, '<span class="text-success">Output</span>');
//
// $categoryId = 3;
// $r = $traxion->payment_categories_methods($username, $password, $categoryId);
// print_r($r, '<span class="text-success">Output</span>');

// $amount = 10;
// $paymentMethod = 131; // GCASH
// $paymentCategoryID = 3;
// $institutionID = 36837;
// $aggregatorID = 11;
// $r = $traxion->cash_in_gcash($username, $password, $amount, $paymentMethod, $paymentCategoryID, $institutionID, $aggregatorID);
// print_r($r, '<span class="text-success">Output</span>');

// $amount = 10;
// $institutionId = 36837;
// $aggregatorId = 11;
// $r = $traxion->cash_in_gcash_fee($username, $password, $amount, $institutionId, $aggregatorId);
// print_r($r, '<span class="text-success">Output</span>');

// $referenceNumber = 'TXN4ba8bc3e64d342c5';
// $r = $traxion->details_merchant_reference($username, $password, $referenceNumber);
// print_r($r);

// $r = $traxion->transaction_history($username, $password);
// print_r($r, '<span class="text-success">Output</span>');
