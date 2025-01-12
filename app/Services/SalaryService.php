<?php

namespace App\Services;

use App\Actions\SalaryAction;
use App\Enums\TaxRate;
use App\Http\Requests\SalaryRequest;
use PhpParser\Node\Expr\Cast\Double;

class SalaryService
{
    private int $grossAnnualSalary;
    private float $grossMonthlySalary;
    private float $netAnnualSalary;
    private float $netMonthlySalary;
    private float $annualTaxPaid;
    private float $monthlyTaxPaid;


    /**
     * Create a new class instance.
     */
    public function __construct(private readonly SalaryAction $salaryAction)
    {

    }

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
        return $this->grossMonthlySalary = $this->salaryAction->calculateGrossMonthlySalary($this->grossAnnualSalary);
    }

    public function setGrossMonthlySalary(float $grossMonthlySalary): void
    {
        $this->grossMonthlySalary = $grossMonthlySalary;
    }

    public function getNetAnnualSalary()
    {
        $tax = $this->salaryAction->taxPaid($this->grossAnnualSalary);

        return $this->netAnnualSalary = $this->salaryAction->findNetAnnualSalary($tax, $this->grossAnnualSalary);
    }

    public function setNetAnnualSalary(float $netAnnualSalary): void
    {
        $this->netAnnualSalary = $netAnnualSalary;
    }

    public function getNetMonthlySalary(): float
    {

        return $this->netMonthlySalary = $this->salaryAction->calculateNetMonthlySalary($this->getNetAnnualSalary());
    }

    public function setNetMonthlySalary(float $netMonthlySalary): void
    {
        $this->netMonthlySalary = $netMonthlySalary;
    }

    public function getAnnualTaxPaid(): float
    {
        return $this->annualTaxPaid;
    }

    public function setAnnualTaxPaid(float $annualTaxPaid): void
    {
        $this->annualTaxPaid = $annualTaxPaid;
    }

    public function getMonthlyTaxPaid(): float
    {
        return $this->monthlyTaxPaid;
    }

    public function setMonthlyTaxPaid(float $monthlyTaxPaid): void
    {
        $this->monthlyTaxPaid = $monthlyTaxPaid;
    }


}
