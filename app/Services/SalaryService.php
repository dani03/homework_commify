<?php

namespace App\Services;

use App\Actions\SalaryAction;
use Illuminate\Support\Collection;

class SalaryService
{
    private int $grossAnnualSalary;

    private float $annualTaxPaid;

    /**
     * Create a new class instance.
     */
    public function __construct(private readonly SalaryAction $salaryAction) {}

    public function getGrossAnnualSalary(): int
    {
        return $this->grossAnnualSalary;
    }

    public function setGrossAnnualSalary(int $grossAnnualSalary): void
    {

        $this->grossAnnualSalary = $grossAnnualSalary;
    }

    public function getGrossMonthlySalary(): float
    {
        return $this->salaryAction->calculateGrossMonthlySalary($this->grossAnnualSalary);
    }

    /**
     * get net annual salary
     */
    public function getNetAnnualSalary(): float
    {
        $annualTax = (int) $this->getAnnualTaxPaid();

        return $this->salaryAction->findNetAnnualSalary($annualTax, $this->grossAnnualSalary);
    }

    /**
     * get net monthly salary
     */
    public function getNetMonthlySalary(): float
    {
        return $this->salaryAction->calculateNetMonthlySalary((int) $this->getNetAnnualSalary());
    }

    /**
     * to get the annual tax paid of a salary
     */
    public function getAnnualTaxPaid(): float
    {
        return $this->annualTaxPaid = $this->salaryAction->annualTaxPaid($this->grossAnnualSalary);

    }

    /**
     * get monthly tax paid
     */
    public function getMonthlyTaxPaid(): float
    {
        return round($this->annualTaxPaid / 12, 2);
    }

    /**
     * get all the details of a salary
     * gross annual salary net salary tax annual paid etc...
     *
     * @return Collection<string, float|int>
     */
    public function allSalaryDetails(): Collection
    {
        return collect([
            'grossAnnualSalary' => $this->getGrossAnnualSalary(),
            'grossMonthlySalary' => $this->getGrossMonthlySalary(),
            'netAnnualSalary' => $this->getNetAnnualSalary(),
            'netMonthlySalary' => $this->getNetMonthlySalary(),
            'annualTaxPaid' => $this->getAnnualTaxPaid(),
            'monthlyTaxPaid' => $this->getMonthlyTaxPaid(),
        ]);
    }
}
