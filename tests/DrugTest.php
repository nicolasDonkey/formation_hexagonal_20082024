<?php

namespace App\Tests;

use App\Prescription\Model\Drug;
use App\Prescription\Model\DrugPackaging;
use App\Prescription\Model\Posology;
use App\Prescription\Model\Prescription;
use App\Prescription\Repository\DrugDictionary;
use DateTime;
use PHPUnit\Framework\TestCase;


class DrugTest extends TestCase
{
    // Help them find a substitute to a drug;
    public function testFindSubstituteToADrug(): void
    {

        $doliprane = new Drug(name: 'Doliprane', activePrinciple: 'paracetamol', drugPackaging: new DrugPackaging(20));
        $dafalgan = new Drug(name: 'Dafalgan', activePrinciple: 'paracetamol', drugPackaging: new DrugPackaging(20));

        $drugDictionary = $this->createMock(DrugDictionary::class);
        $drugDictionary->method('findAllDrugsByActivePrinciple')->willReturn([$dafalgan]);

        $this->assertSame([$dafalgan], $doliprane->findSubstitute($drugDictionary));
    }

    public function testHelpAPharmacistComputeTheNumberOfBoxesToDeliver(): void
    {
        $doliprane = new Drug(name: 'Doliprane', activePrinciple: 'paracetamol', drugPackaging: new DrugPackaging(5));

        $prescription = new Prescription(
            date: new DateTime('20-08-2024'),
            endDate: new DateTime('30-08-2024'),
            drug: $doliprane,
            posology: new Posology(numberOfPill: 2, frequency: 'daily')
        );

        $this->assertSame(4, $prescription->getNumberOfBoxes());
    }

    public function testHelpAPharmacistComputeTheNumberOfBoxesToDeliverWithRounding(): void
    {
        $doliprane = new Drug(name: 'Doliprane', activePrinciple: 'paracetamol', drugPackaging: new DrugPackaging(20));

        $prescription = new Prescription(
            date: new DateTime('20-08-2024'),
            endDate: new DateTime('30-08-2024'),
            drug: $doliprane,
            posology: new Posology(numberOfPill: 1, frequency: 'daily')
        );

        $this->assertSame(1, $prescription->getNumberOfBoxes());
    }
}
