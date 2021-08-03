<?php

namespace Splendex\Service;

use Splendex\Entity\User;
use Splendex\Entity\Transaction;

class OpenCsvService
{

    private $filePointer;

    // @TODO simplify csv get/set.

    public function getCsv($filename)
    {
        $users = [];
        $row = 1;
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;
                $user = new User();
                $user->setAccount($data[0]);
                $user->setAmount($data[1]);
                $users[$user->getAccount()] = $user;
            }
            fclose($handle);
        }
        return $users;
    }

    public function putCsv(String $filename, Array $users): Void
    {
        $this->filePointer = fopen($filename, 'w');
        foreach ($users as $user) {
            fputcsv($this->filePointer, [$user->getAccount(), $user->getAmount()]);
        }
        
    }
    
    public function putLogCsv(String $filename, Array $transactions): Void
    {
        $this->filePointer = fopen($filename, 'w');
        foreach ($transactions as $transaction) {
            fputcsv($this->filePointer, [
                $transaction->getAmount(), 
                $transaction->getAccountId(), 
                $transaction->getTargetAccountId(), 
                $transaction->getDate(), 
                $transaction->getType()
            ]);
        }
        
    }

    public function getLogCsv($filename)
    {
        // $this->filePointer = fopen($this->getFilename(), 'r');
        // fputcsv($this->filePointer, ['AccountID', 'Amount']);
        $transactions = [];
        $row = 1;
        if (($handle = fopen($filename, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);
                $row++;
                $transaction = new Transaction();
                $transaction->setAmount($data[0]);
                $transaction->setAccountId($data[1]);
                $transaction->setTargetAccountId($data[2]);
                $transaction->setDate($data[3]);
                $transaction->setType($data[4]);
                $transactions[] = $transaction;
            }
            fclose($handle);
        }
        return $transactions;
    }
}