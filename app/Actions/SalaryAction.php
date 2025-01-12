<?php

namespace App\Actions;

use App\Enums\AnnualSalaryRange;
use App\Enums\TaxRate;
use App\Repositories\TaxRateRepository;
use Illuminate\Support\Collection;

class SalaryAction
{
    private array $allSalaryRanges = [];

    public function __construct(private readonly TaxRateRepository $taxRateRepository)
    {
    }

    public function getAllTaxes(): Collection | null
    {
        return $this->taxRateRepository->allTaxes();
    }


    public function calculateGrossMonthlySalary(int $salary, $months = 12): float
    {

        $salaryByMonth = $salary / $months;
        return self::format_float_salary($salaryByMonth);
    }

    public function findAnnualSalaryRange(int $salary): int
    {
        $percentage = 0;
        switch ($salary) {
            case $salary < $this->taxRateRepository->taxBandA()->annual_salary_range:

                $percentage = $this->taxRateRepository->taxBandA()->percent;
                break;
            case $salary < $this->taxRateRepository->taxBandB()->annual_salary_range;
                $percentage = $this->taxRateRepository->taxBandB()->percent;
                break;
            default :
                $percentage = $this->taxRateRepository->taxBandC()->percent;

        }
        return $percentage;
    }

    public static function format_float_salary(float $salary): float
    {
        return round($salary, 2);

    }

    /**
     * @param int $salary
     * @return float|int
     */
    public function annualTaxPaid(int $salary): float|int
    {

        $annualTaxPaid = 0;
        //check before if the salary is taxable
       if(!$this->salaryIsTaxable($salary)) {
           return $annualTaxPaid;
       }
        if ($salary >= $this->taxRateRepository->taxBandA()->annual_salary_range) {
            $annualTaxPaid +=
                $this->taxRateRepository->taxBandA()->annual_salary_range *
                $this->taxRateRepository->taxBandA()->percent / 100;
        }

        // vérifie si ton salaire est supérieure au montant du 2eme palier
        if ($salary > $this->taxRateRepository->taxBandB()->annual_salary_range) {

            $amountToTax = $this->taxRateRepository->taxBandB()->annual_salary_range -
                $this->taxRateRepository->taxBandA()->annual_salary_range;
            $annualTaxPaid += ($amountToTax * $this->taxRateRepository->taxBandB()->percent) / 100;
        } else {
            $amountToTax = $salary - $this->taxRateRepository->taxBandA()->annual_salary_range;
            $annualTaxPaid += ($amountToTax * $this->taxRateRepository->taxBandB()->percent) / 100;
        }


        if ($salary > $this->taxRateRepository->taxBandB()->annual_salary_range) {
            $annualTaxPaid += ($salary - $this->taxRateRepository->taxBandB()->annual_salary_range) *
                $this->taxRateRepository->taxBandC()->percent / 100;
        }


        return $annualTaxPaid;

    }
    public function salaryIsTaxable(int $grossSalary): bool
    {
        return $grossSalary > $this->taxRateRepository->taxBandA()->annual_salary_range;
    }

    public function findNetAnnualSalary(int $tax, int $salary): int
    {
       return  $this->salaryIsTaxable($salary) ? $salary - $tax : $salary;

    }

    public function calculateNetMonthlySalary(int $netSalary, int $months = 12): string
    {
        return self::format_float_salary($netSalary / $months);
    }



}
