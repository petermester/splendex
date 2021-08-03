<?php

namespace Splendex\Entity;

use \DateTime;

class Transaction
{
    private $amount;
    private $accountId;
    private $targetAccountId;
    private $date;
    private $type;
    private $balance;

    public function setAmount(String $amount): void
    {
        $this->amount = $amount;
    }

    public function setAccountId(String $accountId): void
    {
        $this->accountId = $accountId;
    }

    public function setTargetAccountId(String $targetAccountId): void
    {
        $this->targetAccountId = $targetAccountId;
    }

    public function setDate(String $date): void
    {
        $this->date = $date;
    }

    public function setType(String $type): void
    {
        $this->type = $type;
    }

    public function setBalance(String $balance): void
    {
        $this->balance = $balance;
    }

    public function getAmount(): ?String
    {
        return $this->amount;
    }

    public function getAccountId(): ?String
    {
        return $this->accountId;
    }

    public function getTargetAccountId(): ?String
    {
        return $this->targetAccountId;
    }

    public function getDate(): ?String
    {
        return $this->date;
    }

    public function getType(): ?String
    {
        return $this->type;
    }    

    public function getBalance(): ?String
    {
        return $this->balance;
    } 
}