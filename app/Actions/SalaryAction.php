<?php

namespace App\Actions;

use App\Enums\AnnualSalaryRange;
use App\Enums\TaxRate;

class SalaryAction
{
    private array $allSalaryRanges = [];

    public function __construct()
    {
    }

    public function getAllSalaryRanges(): array
    {
        return AnnualSalaryRange::allSalaryRange();
    }


    public function calculateGrossMonthlySalary(int $salary, $months = 12): float
    {
        $salaryByMonth = $salary / $months;
        return self::format_float_salary($salaryByMonth);
    }

    public function findAnnualSalaryRange(int $salary): int
    {
        $range = 0;
        switch ($salary) {
            case $salary < AnnualSalaryRange::rangeSalaryA:
                $range = TaxRate::taxBandA->value;
                break;
            case $salary < AnnualSalaryRange::rangeSalaryB;
                $range = TaxRate::taxBandB->value;
                break;
            default :
                $range = TaxRate::taxBandC->value;

        }
        return $range;
    }

    public static function format_float_salary(float $salary): float
    {
        return round($salary, 2);

    }

    public function taxPaid(int $salary)
    {
        $amountTax = 0;
        if ($salary >= AnnualSalaryRange::rangeSalaryA->value) {

            $amountTax += AnnualSalaryRange::rangeSalaryA->value * AnnualSalaryRange::taxBandA->value / 100;
        }

        // vérifie si ton salaire est supérieure au montant du 2eme palier
        if ($salary > AnnualSalaryRange::rangeSalaryB->value) {

            $amountToTax = AnnualSalaryRange::rangeSalaryB->value - AnnualSalaryRange::rangeSalaryA->value;
            $amountTax += ($amountToTax * AnnualSalaryRange::taxBandB->value) / 100;
        } else {
            $amountToTax = $salary - AnnualSalaryRange::rangeSalaryA->value;
            $amountTax += ($amountToTax * AnnualSalaryRange::taxBandB->value) / 100;
        }

        if ($salary > AnnualSalaryRange::rangeSalaryB->value) {

            $amountTax += ($salary - AnnualSalaryRange::rangeSalaryB->value) * AnnualSalaryRange::taxBandC->value / 100;
        }

        return $amountTax;

    }

    public function findNetAnnualSalary(int $tax, int $salary): int
    {
        return $salary - $tax ;
    }

    public function calculateNetMonthlySalary(int $netSalary, int $months = 12): string
    {
        return self::format_float_salary($netSalary / $months);
    }


}
