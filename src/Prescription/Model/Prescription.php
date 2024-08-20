<?php

namespace App\Prescription\Model;

use DateTime;

class Prescription
{
    // public bool $isRenewable;

    public function __construct(
        private DateTime $date,
        private DateTime $endDate,
        private Drug $drug,
        private Posology $posology
    ) {
    }

    // If multiple drugs
    // public function getNumberOfBoxesByDrug(Drug $drug): int
    public function getNumberOfBoxes(): int
    {
        $durationInDays = $this->date->diff($this->endDate)->days;

        $nbOfPill = $this->posology->numberOfPill * $durationInDays;

        return $this->drug->computeNumberOfBoxes($nbOfPill);
    }
}
