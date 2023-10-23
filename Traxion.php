<?php

define('TRAXION_APPLICATION_ID', 1);

class Traxion {

  function __construct($debug = false) {
    $this->debug = $debug;
  }

  function init($url, $secretKey, $debug = false) {
    $this->url = $url;
    $this->secretKey = $secretKey;
    $this->debug = $debug;
  }

  function login_thirdparty($username, $password) {
    $request_url = $this->url . '/api/v1/auth/login/thirdparty';

    $params = array(
      'username' => $username,
      'password' => $password,
      'applicationId' => 1
    );

    $encrypted_data = $this->params_to_encrypted_data($params, $this->secretKey);
    $data = array('data' => $encrypted_data);

    $headers[] = 'Content-Type: application/json';

    $output = $this->get_response($this->post($request_url, $data, $headers));
    if ($this->debug) {
      print_pre($output, '<span class="text-success">Output</span>');
    }
    return $output;
  }

  function account_number($username, $password) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;

    $request_url = $this->url . '/api/v1/users/account-number';
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, array(), $headers));
  }

  function wallet($username, $password) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;

    $request_url = $this->url . '/api/v1/users/thirdparty/wallet';
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, array(), $headers));
  }

  // TODO: Default values are from the documentation
  function funds_transfer_bulk($username, $password, $batchIdentifier = "batch-may-2-1", 
      $institutionID = 37225, $accountNumber = "09267912280", $merchantReferenceNumber = "09267912280", 
      $amount = 100, $recipientName = "Floyd Matabilas", $mobileNumber = "09267912280", $tag = 1,
      $notifyRecipient = 1, $purpose = 1, $message = '') {

    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;

    $request_url = $this->url . '/api/v1/transactions/funds/transfer/bulk';

    $params = array(
      'batchIdentifier' => $batchIdentifier,
      'institutionID' => $institutionID,
      'accountNumber' => $accountNumber,
      'merchantReferenceNumber' => $merchantReferenceNumber,
      'amount' => $amount,
      'recipientName' => $recipientName,
      'mobileNumber' => $mobileNumber,
      'tag' => $tag,
      'notifyRecipient' => $notifyRecipient,
      'purpose' => $purpose,
      'message' => $message,
    );
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function qr_generate($username, $password, $amount) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;

    $request_url = $this->url . '/api/v1/transactions/external/bank-transfer/qr/generate';

    $params = array(
      'amount' => $amount,
    );
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function qr_generate_merchant($username, $password, $amount) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;

    $request_url = $this->url . '/api/v1/transactions/external/bank-transfer/qr/generate/merchant';

    $params = array(
      'amount' => $amount,
    );
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function bank_transfer_qr_check($username, $password, $batchIdentifier) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;

    $request_url = $this->url . '/api/v1/transactions/external/bank-transfer/qr/check';

    $params = array(
      // 'batchIdentifier' => $batchIdentifier,
      'qr' => $batchIdentifier,
    );
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function bank_transfer_qr($username, $password, $qr, $merchantReferenceNumber, $amount, $description) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;

    $request_url = $this->url . '/api/v1/transactions/external/bank-transfer/qr';

    $params = array(
      'qr' => $qr,
      'merchantReferenceNumber' => $merchantReferenceNumber,
      'amount' => $amount,
      'description' => $description,
    );
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function details_merchant_reference($username, $password, $referenceNumber) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;

    $request_url = $this->url . '/api/v1/transactions/details/merchant-reference';

    $params = array(
      'referenceNumber' => $referenceNumber
    );
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);
    $data = array('data' => $encrypted_data);

    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function details_aggregator($username, $password, $referenceNumber) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;

    $request_url = $this->url . '/api/v1/transactions/details/aggregator';

    $params = array(
      'referenceNumber' => $referenceNumber
    );
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function details_batch($username, $password, $referenceNumber) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;

    $request_url = $this->url . '/api/v1/transactions/details/batch';

    $params = array(
      'referenceNumber' => $referenceNumber
    );
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  // TODO: Default values are from the documentation
  function cash_in_gcash($username, $password, $amount, $paymentMethod = 'BOG', $paymentCategoryID = 6, $institutionID = 584, $aggregatorID = 8) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;
    $personCode = $r->data->personCode;
    $walletCode = $r->data->walletCode;

    $request_url = $this->url . '/api/v1/transactions/external/funds/cash-in/gcash';

    $params = array(
      'personCode' => $personCode,
      'walletCode' => $walletCode,
      'transactionDetails' => array(
        array(
          'paymentMethod' => $paymentMethod,
          'amount' => $amount,
          'description' => '',
          'email' => '',
          'firstName' => '',
          'lastName' => '',
          'paymentCategoryID' => $paymentCategoryID,
          'institutionID' => $institutionID,
          'aggregatorID' => $aggregatorID,
        )
      ),
    );
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  // TODO: Default values are from the documentation
  function cash_in_gcash_fee($username, $password, $amount, $institutionId = 13058, $aggregatorId = 11) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;

    $request_url = $this->url . '/api/v1/transactions/external/funds/cash-in/gcash/fee';

    $params = array(
      'institutionId' => $institutionId,
      'aggregatorId' => $aggregatorId,
      'amount' => $amount,
    );
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function payment_categories_methods($username, $password, $categoryId) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;

    $request_url = $this->url . "/api/v1/transactions/external/payment-categories/$categoryId/methods";

    $params = array();
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function payment_categories($username, $password) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;

    $request_url = $this->url . '/api/v1/transactions/external/payment-categories';

    $params = array();
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function transaction_history($username, $password, $page = 1, $limit = 25) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;
    $walletCode = $r->data->walletCode;

    $request_url = $this->url .  '/api/v1/users/thirdparty/transactions/history';

    $params = array(
      'walletCode' => $walletCode,
      'page' => $page,
      'limit' => $limit,
      'status' => null,
    );
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function params_to_encrypted_data($params, $secretKey) {
    if ($this->debug) {
      print_pre($params, '<span class="text-info">Parameters</span>');
    }
    $totp = my_totp_now($secretKey);
    $json_params = json_encode($params);
    $encrypted_data = gibberish_aes_encrypt($json_params,  $totp);
    return $encrypted_data;
  }

  function post($request_url, $data, $headers) {
    $ch = curl_init();

    if ($this->debug) {
      echo '<p class="text-danger">Requesting ' . $request_url . '</p>';
      print_pre($headers, '<span class="text-danger">Headers</span>');
      print_pre($data, '<span class="text-danger">Encrypted Data</span>');
    }
    curl_setopt($ch, CURLOPT_URL, $request_url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

    $output = curl_exec($ch);
    return $output;
  }

  function get_response($response) {
    // if (!$this->debug) {
      $response = json_decode($response);
    // }
    return $response;
  }

}
