<?php

require_once 'src/entity/User.php';
require_once 'src/entity/Transaction.php';
require_once 'src/service/CsvGeneratorService.php';
require_once 'src/service/OpenCsvService.php';
require_once 'src/service/WhitdrawDepositService.php';
require_once 'src/service/TransactionService.php';


use Splendex\Entity\User;
use Splendex\Entity\Transaction;
use Splendex\Service\CsvGeneratorService;
use Splendex\Service\OpenCsvService;
use Splendex\Service\WhitdrawDepositService;
use Splendex\Service\TransactionService;

$usersFile = "users.csv";
$transactionsFile = "transactions.csv";

$transactionType;
$userId;
$targetUserId;
$amount;
$filterType; // Whitdraw or deposit.
$filterDate;

$opencsv = new OpenCsvService();
$users = $opencsv->getCsv($usersFile);

$whitdrawDepositService = new WhitdrawDepositService();

$transactionService = new TransactionService();
$transactions = $opencsv->getLogCsv($transactionsFile);

// print_r($users);

// @TODO simplify TransactionService.


if (isset($argv[1])) {
    $transactionType = $argv[1];
    // php -f splendex.php TRANSACTIONTYPE USERID AMOUNT
    if ($transactionType == 'deposit') {
        if (isset($argv[2]) && isset($argv[3])) {
            $userId = $argv[2];
            $amount = $argv[3];
            // Update the user.
            $whitdrawDepositService->deposit($userId, $amount, $users);
            // Log the transaction.
            $transaction = new Transaction();
            $transaction->setAmount($amount);
            $transaction->setAccountId($userId);
            $transaction->setType('deposit');
            $timestamp = new DateTime("now");
            $transaction->setDate($timestamp->format('Y-m-d H:i:s'));
            $transactions[] = $transaction;
        }
    }
    elseif ($transactionType == 'whitdraw') {
        if (isset($argv[2]) && isset($argv[3])) {
            $userId = $argv[2];
            $amount = $argv[3];
            // Update the user.
            $whitdrawDepositService->whitdraw($userId, $amount, $users);
            // Log the transaction.
            $transaction = new Transaction();
            $transaction->setAmount($amount);
            $transaction->setAccountId($userId);
            $transaction->setType('whitdraw');
            $timestamp = new DateTime("now");
            $transaction->setDate($timestamp->format('Y-m-d H:i:s'));
            $transactions[] = $transaction;
        }
    }
    // php -f splendex.php TRANSACTIONTYPE USERID TARGETUSERID AMOUNT
    elseif ($transactionType == 'transfer') {
        if (isset($argv[2]) && isset($argv[3]) && isset($argv[4])) {
            $userId = $argv[2];
            $targetUserId = $argv[3];
            $amount = $argv[4];
            $transactionService->sendMoney($userId, $targetUserId, $amount, $users);
            // Log the transaction.
            $transaction = new Transaction();
            $transaction->setAmount($amount);
            $transaction->setAccountId($userId);
            $transaction->setTargetAccountId($targetUserId);
            $transaction->setType('transfer');
            $timestamp = new DateTime("now");
            $transaction->setDate($timestamp->format('Y-m-d H:i:s'));
            $transactions[] = $transaction;
        }
    }
    // php -f splendex.php TRANSACTIONTYPE USERID FILTERTYPE FILTERDATE
    elseif ($transactionType == 'history') {
        if (isset($argv[2]) && isset($argv[3]) && isset($argv[4])) {
            $userId = $argv[2];
            $filterType = $argv[3];
            $filterDate = $argv[4];
        }
    }
}

// Write back everything into the csv file.
$opencsv->putCsv($usersFile, $users);

$opencsv->putLogCsv($transactionsFile, $transactions);
