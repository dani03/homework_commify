<?php

namespace App\Actions;

use App\Repositories\TaxRateRepository;

readonly class SalaryAction
{
    public function __construct(private TaxRateRepository $taxRateRepository) {}

    /**
     * calculate gross monthly salary
     */
    public function calculateGrossMonthlySalary(int $salary, int $months = 12): float
    {

        $salaryByMonth = $salary / $months;

        return self::format_float_salary($salaryByMonth);
    }

    public static function format_float_salary(float $salary): float
    {
        return round($salary, 2);
    }

    /**
     * get the annual tax paid of a salary
     */
    public function annualTaxPaid(int $salary): float|int
    {
        $annualTaxPaid = 0;

        // Check before if the salary is taxable
        if (! $this->salaryIsTaxable($salary)) {
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
                if (! $isLast) {
                    if ($salary > $taxBand->annual_salary_range) {

                        $amountToTax = $taxBand->annual_salary_range - $previousBandLimit;
                        $annualTaxPaid += ($amountToTax * $taxBand->percent) / 100;
                        $previousBandLimit = $taxBand->annual_salary_range;
                    } else {
                        // Si le salaire est dans ce palier, on calcule le montant restant à imposer
                        $amountToTax = $salary - $previousBandLimit;
                        $annualTaxPaid += ($amountToTax * $taxBand->percent) / 100;

                    }
                } elseif ($salary >= $taxBand->annual_salary_range) {

                    $amountToTax = $salary - $previousBandLimit;
                    $annualTaxPaid += ($amountToTax * $taxBand->percent) / 100;
                }
            }
        }

        return $annualTaxPaid;
    }

    /**
     * find if the salary is taxable
     */
    public function salaryIsTaxable(int $grossSalary): bool
    {
        return $grossSalary > $this->taxRateRepository->taxBandA()->annual_salary_range;
    }

    /**
     * find the net annual salary of a gross salary
     */
    public function findNetAnnualSalary(int $tax, int $salary): int
    {
        return $this->salaryIsTaxable($salary) ? $salary - $tax : $salary;

    }

    /**
     * to calculate monthly net salary
     */
    public function calculateNetMonthlySalary(int $netSalary, int $months = 12): float
    {
        return self::format_float_salary($netSalary / $months);
    }
}
