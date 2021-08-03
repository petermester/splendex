<?php

namespace Splendex\Service;

use Splendex\Entity\User;
use \DateTime;

class WhitdrawDepositService
{
    private $whitdrawAmount;
    private $depositAmount;
    private $user;
    private $users;

    public function __construct()
    {
        // $this->user = new User();
    }

    public function deposit(String $id, String $amount, Array $users): void
    {
        $currentAmount = $users[$id]->getAmount();
        $users[$id]->setAmount($currentAmount + $amount);
    }

    public function whitdraw(String $id, String $amount, Array $users): void
    {
        // @TODO handle minus balance.
        // $currentAmount = $this->user->getAmount();
        // $this->user->setAmount($currentAmount - $amount);

        $currentAmount = $users[$id]->getAmount();
        $users[$id]->setAmount($currentAmount - $amount);
    }
}