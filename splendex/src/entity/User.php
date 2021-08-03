<?php

namespace Splendex\Entity;

use \DateTime;

class User
{
    private $amount;
    private $accountId;

    public function setAmount(String $amount): void
    {
        $this->amount = $amount;
    }

    public function setAccount(String $accountId): void
    {
        $this->accountId = $accountId;
    }

    public function getAmount(): ?String
    {
        return  $this->amount;
    }

    public function getAccount(): ?String
    {
        return $this->accountId;
    }
}