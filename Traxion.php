<?php

define('TRAXION_APPLICATION_ID', 1);

class Traxion {

  function __construct($debug = false) {
    $this->debug = $debug;
  }

  function init($url, $secret_key, $debug) {
    $this->url = $url;
    $this->secret_key = $secret_key;
    $this->debug = $debug;
  }

  function login_thirdparty($username, $password) {
    $request_url = $this->url . '/api/v1/auth/login/thirdparty';

    $params = array(
      'username' => $username,
      'password' => $password,
      'applicationId' => 1
    );

    $encrypted_data = $this->params_to_encrypted_data($params, $this->secret_key);
    $data = array('data' => $encrypted_data);

    $headers[] = 'Content-Type: application/json';

    $output = $this->get_response($this->post($request_url, $data, $headers));
    if ($this->debug) {
      print_pre($output, 'output');
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

  function funds_transfer_bulk($username, $password) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;
    $merchantCode = $r->data->merchantCode;

    $request_url = $this->url . '/api/v1/transactions/funds/transfer/bulk';

    $params = array(
      'batchIdentifier' => "batch-may-2-1",
      'institutionID' => 37225,
      'accountNumber' => "09267912280",
      'merchantReferenceNumber' => "reference-may-2-1",
      'amount' => 100,
      'recipientName' => "Floyd Matabilas",
      'mobileNumber' => "09267912280",
      'tag' => 1,
      'notifyRecipient' => 1,
      'purpose' => 1,
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
      'ref_no' => 'lalala',
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
    $totp = my_totp_now($secretKey);
    $json_params = json_encode($params);
    $encrypted_data = gibberish_aes_encrypt($json_params,  $totp);

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
    $totp = my_totp_now($secretKey);
    $json_params = json_encode($params);
    $encrypted_data = gibberish_aes_encrypt($json_params,  $totp);

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

  function details_aggregator($accessToken, $referenceNumber, $secretKey) {
    $request_url = $this->url . '/api/v1/transactions/details/aggregator';

    $params = array(
      'referenceNumber' => $referenceNumber
    );
    $totp = my_totp_now($secretKey);
    $json_params = json_encode($params);
    $encrypted_data = gibberish_aes_encrypt($json_params,  $totp);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function details_batch($accessToken, $referenceNumber, $secretKey) {
    $request_url = $this->url . '/api/v1/transactions/details/batch';

    $params = array(
      'referenceNumber' => $referenceNumber
    );
    $totp = my_totp_now($secretKey);
    $json_params = json_encode($params);
    $encrypted_data = gibberish_aes_encrypt($json_params,  $totp);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function cash_in_gcash($username, $password, $amount) {
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
          'paymentMethod' => 'BOG',
          'amount' => $amount,
          'description' => '',
          'email' => '',
          'firstName' => '',
          'lastName' => '',
          'paymentCategoryGroupID' => 6,
          'institutionID' => 584,
          'aggregatorID' => 8,
        )
      ),
    );
    $encrypted_data = $this->params_to_encrypted_data($params, $secretKey);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function cash_in_gcash_fee($username, $password, $amount) {
    $r = $this->login_thirdparty($username, $password);
    $accessToken = $r->data->accessToken;
    $secretKey = $r->data->secretKey;

    $request_url = $this->url . '/api/v1/transactions/external/funds/cash-in/gcash/fee';

    $params = array(
      'institutionId' => 13058,
      'aggregatorId' => 11,
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
    return $this->get_response($this->post($request_url, array(), $headers));
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

  function transaction_history($accessToken, $walletCode, $secretKey) {
    $request_url = $this->url .  '/api/v1/users/thirdparty/transactions/history';

    $params = array(
      'walletCode' => $walletCode,
      'page' => 1,
      'limit' => 2,
      'status' => null,
    );
    $totp = my_totp_now($secretKey);
    $json_params = json_encode($params);
    $encrypted_data = gibberish_aes_encrypt($json_params,  $totp);

    $data = array('data' => $encrypted_data);
    $headers[] = 'Content-Type: application/json';
    $headers[] = 'Authorization: Bearer ' . $accessToken;
    return $this->get_response($this->post($request_url, $data, $headers));
  }

  function params_to_encrypted_data($params, $secretKey) {
    if ($this->debug) {
      print_pre($params, 'params');
    }
    $totp = my_totp_now($secretKey);
    $json_params = json_encode($params);
    $encrypted_data = gibberish_aes_encrypt($json_params,  $totp);
    return $encrypted_data;
  }

  function post($request_url, $data, $headers) {
    $ch = curl_init();

    if ($this->debug) {
      echo $request_url . '<br>';
      print_pre($headers);
      print_pre($data);
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
