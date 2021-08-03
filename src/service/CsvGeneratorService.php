<?php

namespace Splendex\Service;

use Splendex\Entity\User;

class CsvGeneratorService
{
    private $filename;
    private $filePointer;

    public function __construct(string $filename)
    {
        $this->setFilename($filename);
    }

    public function setFilename(string $filename): void
    {
        $this->filename = $filename;
    }

    public function getFilename(): string
    {
        return $this->filename;
    }

    public function openCsv(): void
    {
        $this->filePointer = fopen($this->getFilename(), 'w');
        fputcsv($this->filePointer, ['AccountID', 'Amount']);
    }

    public function addPayment(User $user): void
    {
        fputcsv($this->filePointer, [
            $user->getAccount(),
            $user->getAmount(),
        ]);
    }

    public function closeCsv(): void
    {
        fclose($this->filePointer);
    }
}