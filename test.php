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

// $r = $traxion->account_number($username, $password); // OK
// print_pre($r, '<span class="text-success">Output</span>');

// $r = $traxion->wallet($username, $password); // OK
// print_pre($r, '<span class="text-success">Output</span>');

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
// print_pre($r, '<span class="text-success">Output</span>');

// $amount = 1;
// $r = $traxion->qr_generate_merchant($username, $password, $amount); // OK
// $qr = $r->data->rawString;
// print_pre($r, '<span class="text-success">Output</span>');
// echo "<img src='https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=$qr&choe=UTF-8'><br>";

// $qr = '00020101021228780011ph.ppmi.p2m0111TRXPPHM2XXX03171016202300004685604161001173251356404050300052046016530360854041.005802PH5907OLYMPUS6010PASIG CITY623505062110000014D00KF0QIXBSQHH0803***88490012ph.ppmi.qrph0129006395677194150211BCPIPHSSXXX63048A2D';
// $r = $traxion->bank_transfer_qr_check($username, $password, $qr); // OK
// print_pre($r, '<span class="text-success">Output</span>');

$qr = '00020101021228780011ph.ppmi.p2m0111TRXPPHM2XXX03171016202300004685604161001173251356404050300052046016530360854041.005802PH5907OLYMPUS6010PASIG CITY623505062110000014D00KF0QIXBSQHH0803***88490012ph.ppmi.qrph0129006395677194150211BCPIPHSSXXX63048A2D';
$merchantReferenceNumber = ''; // TODO: Where to get this?
$amount = 1;
$description = '';
$r = $traxion->bank_transfer_qr($username, $password, $qr, $merchantReferenceNumber, $amount, $description);
print_pre($r, '<span class="text-success">Output</span>');

// $referenceNumber = '211000'; // TODO: Where to get this?
// $r = $traxion->details_merchant_reference($username, $password, $referenceNumber);
// print_pre($r, '<span class="text-success">Output</span>');

// $referenceNumber = '211000'; // TODO: Where to get this?
// $r = $traxion->details_aggregator($username, $password, $referenceNumber);
// print_pre($r, '<span class="text-success">Output</span>');

// $referenceNumber = '211000'; // TODO: Where to get this?
// $r = $traxion->details_batch($username, $password, $referenceNumber);
// print_pre($r, '<span class="text-success">Output</span>');

// $r = $traxion->payment_categories($username, $password);
// print_pre($r, '<span class="text-success">Output</span>');

// $categoryId = 3;
// $r = $traxion->payment_categories_methods($username, $password, $categoryId);
// print_pre($r, '<span class="text-success">Output</span>');

// $amount = 10;
// $r = $traxion->cash_in_gcash($username, $password, $amount);
// print_pre($r, '<span class="text-success">Output</span>');

// $amount = 10;
// $r = $traxion->cash_in_gcash_fee($username, $password, $amount);
// print_pre($r, '<span class="text-success">Output</span>');

// $r = $traxion->transaction_history($username, $password); // OK
// print_pre($r, '<span class="text-success">Output</span>');