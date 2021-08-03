<?php

namespace Splendex\Service;

use Splendex\Entity\User;
use \DateTime;

class TransactionService
{
    private $whitdrawAmount;
    private $depositAmount;
    private $user;
    private $users;

    public function __construct()
    {
        // $this->user = new User();
    }

    public function sendMoney(String $id, String $targetId, String $amount, Array $users): void
    {
        // @TODO handle minus balance.
        $currentAmount = $users[$id]->getAmount();
        $users[$id]->setAmount($currentAmount - $amount);

        $currentTargetAmount = $users[$targetId]->getAmount();
        $users[$targetId]->setAmount($currentTargetAmount + $amount);
    }
}