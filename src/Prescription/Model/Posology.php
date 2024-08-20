<?php

namespace App\Prescription\Model;

// → (1 cachet / matin et midi)
// → (1 cachet / 1 fois tous les 2 jours)
class Posology
{
    public function __construct(
        public int $numberOfPill,
        private string $frequency
    ) {
    }
}
