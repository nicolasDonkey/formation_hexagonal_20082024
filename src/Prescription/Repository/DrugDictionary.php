<?php

namespace App\Prescription\Repository;

use App\Prescription\Model\Drug;

interface DrugDictionary
{
    /** @return Drug[] */
    public function findAllDrugsByActivePrinciple(string $name): array;
}
