<?php

namespace App\Prescription\Model;

class DrugPackaging
{
    public function __construct(
        public int $numberOfPill
    ) {
    }
}
