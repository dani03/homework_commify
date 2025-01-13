<?php

namespace App\Services;

use App\Actions\SalaryAction;
use App\Enums\TaxRate;
use App\Http\Requests\SalaryRequest;
use Illuminate\Support\Collection;
use PhpParser\Node\Expr\Cast\Double;

class SalaryService
{
    private int $grossAnnualSalary;
    private float $annualTaxPaid;


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

        $this->grossAnnualSalary =  $grossAnnualSalary;
    }

    public function getGrossMonthlySalary(): float
    {
        return  $this->salaryAction->calculateGrossMonthlySalary($this->grossAnnualSalary);
    }

    /**
     * @return float
     */
    public function getNetAnnualSalary(): float
    {
        $annualTax = (int) $this->getAnnualTaxPaid();
        return $this->salaryAction->findNetAnnualSalary($annualTax, $this->grossAnnualSalary);
    }




    public function getNetMonthlySalary(): float
    {
        return  $this->salaryAction->calculateNetMonthlySalary((int) $this->getNetAnnualSalary());
    }



    public function getAnnualTaxPaid(): float
    {
        return $this->annualTaxPaid = $this->salaryAction->annualTaxPaid($this->grossAnnualSalary);

    }

    public function getMonthlyTaxPaid(): float
    {
        return round($this->annualTaxPaid / 12, 2);
    }

    /**
     * @return Collection<string, float|int>
     */
    public function allSalaryDetails(): Collection
    {
      return  collect([
            'grossAnnualSalary' => $this->getGrossAnnualSalary(),
            'grossMonthlySalary' => $this->getGrossMonthlySalary(),
            'netAnnualSalary' => $this->getNetAnnualSalary(),
            'netMonthlySalary' => $this->getNetMonthlySalary(),
            'annualTaxPaid' => $this->getAnnualTaxPaid(),
            'monthlyTaxPaid' => $this->getMonthlyTaxPaid()
        ]);
    }




}
