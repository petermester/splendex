<?php

namespace Inviqa\Entity;

use \DateTime;

class Payment
{
    private $month;
    private $salaryPaymentDate;
    private $bonusPaymentDate;

    public function setMonth(DateTime $month): void
    {
        $this->month = $month;
    }

    public function getMonth(): ?DateTime
    {
        return $this->month;
    }

    public function setSalaryPaymentDate(DateTime $salaryPaymentDate): void
    {
        $this->salaryPaymentDate = $salaryPaymentDate;
    }

    public function getSalaryPaymentDate(): ?DateTime
    {
        return $this->salaryPaymentDate;
    }

    public function setBonusPaymentDate(DateTime $bonusPaymentDate): void
    {
        $this->bonusPaymentDate = $bonusPaymentDate;
    }

    public function getBonusPaymentDate(): ?DateTime
    {
        return $this->bonusPaymentDate;
    }
}