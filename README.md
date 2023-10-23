# Traxion PHP Library

[![License](https://img.shields.io/badge/license-MIT-blue.svg)](https://opensource.org/licenses/MIT)

The Traxion PHP Library is a powerful tool for integrating third-party applications with the Traxion platform. It provides a set of functions and methods for handling authentication, user account management, wallet transactions, and various types of cash-ins including bank and e-wallet payments.

## Table of Contents

- [Installation](#installation)
- [Usage](#usage)
- [Authentication](#authentication)
- [User Account Management](#user-account-management)
- [Wallet Transactions](#wallet-transactions)
- [Cash-Ins](#cash-ins)
- [Contributing](#contributing)
- [License](#license)

## Installation

You can install the Traxion PHP Library via Composer. Run the following command to add it to your project:

```bash
composer require daog-systems/traxion-php-library
```

## Usage

To use this library, you need to initialize it with your API credentials:

```php
require_once('Traxion.php');
$traxion = new Traxion();
// Obtain these values froM Traxtion, test/production
$Url = '';
$secretKey = '';
$username = '';
$password =  '';

$traxion->init($url, $secretKey); // Option debug to display debug data
```

## Authentication

The library provides methods for authentication and obtaining an access token:

```php
// Authenticate with Traxion
$response = $traxion->login_third_party($username, $password);
// Get the access token
$accessToken = $response->data->accessToken;
```

You also need not to issue login function everytime since every function will invoke the login_third_party function to get the latest access token.

## User Account Management

You can manage user accounts using the following methods:

```php
// Gete account number
$account_number = $traxion->account_number($username, $password);
```

## Wallet Transactions

Handle wallet transactions with ease:

```php
// Transfer funds between user wallets
$batchIdentifier = "batch-may-2-1";
$institutionID = 37225;
$accountNumber = "09267912280";
$merchantReferenceNumber = "09267912280";
$amount = 100;
$recipientName = "Floyd Matabilas";
$mobileNumber = "09267912280";
$tag = 1;
$notifyRecipient = 1;
$purpose = 1;
$message = '';
$traxion->funds_transfer_bulk($username, $password, $batchIdentifier,
      $institutionID, $accountNumber, $merchantReferenceNumber,
      $amount, $recipientName, $mobileNumber, $tag,
      $notifyRecipient, $purpose, $message);

// Check wallet balance
$wallet = $traxion->wallet($username, $password);
```

## Cash-Ins

Manage cash-ins from different sources:

```php
// Initiate a bank cash-in
$bankCashInData = ['user' => 'user1', 'amount' => 500, 'bank' => 'BDO'];
$traxion->initiateBankCashIn($bankCashInData);

// Initiate an e-wallet cash-in
$ewalletCashInData = ['user' => 'user2', 'amount' => 200, 'ewallet' => 'GCash'];
$traxion->initiateEwalletCashIn($ewalletCashInData);
```

## Contributing

We welcome contributions from the open-source community. If you find a bug or have an idea for an enhancement, please open an issue or submit a pull request.

Before contributing, please read our Contribution Guidelines.

## License

This project is licensed under the MIT License. Feel free to use, modify, and distribute it as needed.