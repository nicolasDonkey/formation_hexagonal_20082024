<?php

namespace App\Prescription\Model;

use App\Prescription\Repository\DrugDictionary;

class Drug
{
    public function __construct(
        public string $name,
        private readonly string $activePrinciple,
        private readonly DrugPackaging $drugPackaging,
    ) {
    }

    /** @return Drug[] */
    public function findSubstitute(DrugDictionary $dictionary): array
    {
        return $dictionary->findAllDrugsByActivePrinciple($this->activePrinciple);
    }

    public function computeNumberOfBoxes(int $numberOfPillToDeliver): int
    {
        return ceil($numberOfPillToDeliver / $this->drugPackaging->numberOfPill);
    }
}
