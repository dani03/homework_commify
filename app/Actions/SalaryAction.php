<?php

namespace App\Actions;

use App\Enums\AnnualSalaryRange;
use App\Enums\TaxRate;
use App\Repositories\TaxRateRepository;
use Illuminate\Support\Collection;

readonly class SalaryAction
{

    public function __construct(private TaxRateRepository $taxRateRepository)
    {
    }


    public function calculateGrossMonthlySalary(int $salary, int $months = 12): float
    {

        $salaryByMonth = $salary / $months;
        return self::format_float_salary($salaryByMonth);
    }


    public static function format_float_salary(float $salary): float
    {
        return round($salary, 2);
    }


    public function annualTaxPaid(int $salary): float|int
    {
        $annualTaxPaid = 0;


        // Check before if the salary is taxable
        if (!$this->salaryIsTaxable($salary)) {
            return $annualTaxPaid;
        }

        // Get all tax bands sorted by their salary range in ascending order
        $taxBands = $this->taxRateRepository->allTaxes();

        $previousBandLimit = 0; // Tracks the upper limit of the previous band

        $currentIndex = 0;
        if ($taxBands && $taxBands->isNotEmpty()) {
            $totalBands = count($taxBands); // Nombre total d'éléments
            foreach ($taxBands as $taxBand) {
                $currentIndex++;
                $isLast = ($currentIndex === $totalBands);
                if (!$isLast) {
                    if ($salary > $taxBand->annual_salary_range) {

                        $amountToTax = $taxBand->annual_salary_range - $previousBandLimit;
                        $annualTaxPaid += ($amountToTax * $taxBand->percent) / 100;
                        $previousBandLimit = $taxBand->annual_salary_range;
                    } else {
                        // Si le salaire est dans ce palier, on calcule le montant restant à imposer
                        $amountToTax = $salary - $previousBandLimit;
                        $annualTaxPaid += ($amountToTax * $taxBand->percent) / 100;

                    }
                } else if ($salary >= $taxBand->annual_salary_range) {

                    $amountToTax = $salary - $previousBandLimit;
                    $annualTaxPaid += ($amountToTax * $taxBand->percent) / 100;
                }
            }
        }

        return $annualTaxPaid;
    }

    public function salaryIsTaxable(int $grossSalary): bool
    {
        return $grossSalary > $this->taxRateRepository->taxBandA()->annual_salary_range;
    }

    public function findNetAnnualSalary(int $tax, int $salary): int
    {
        return $this->salaryIsTaxable($salary) ? $salary - $tax : $salary;

    }

    public function calculateNetMonthlySalary(int $netSalary, int $months = 12): float
    {
        return self::format_float_salary($netSalary / $months);
    }




}
