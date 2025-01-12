<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaryRequest;
use App\Services\SalaryService;
use Illuminate\Http\Request;

class SalaryController extends Controller
{
    public function __construct(private SalaryService $salaryService)
    {

    }

    public function __invoke(SalaryRequest $request)
    {
        $allOperations = [];
        $salary = $request->salary;
        $this->salaryService->setGrossAnnualSalary($salary);
        $grossMonthlySalary = $this->salaryService->getGrossMonthlySalary();

        $allOperations['gross_annual_salary'] = $salary;
        $allOperations['gross_monthly_salary'] = $grossMonthlySalary;

        // calculate net annual salary
        // salaire net annuel
        $anu = $this->salaryService->getNetAnnualSalary();
        $allOperations['net_annual_salary'] = $anu;

        $monthlySalary = $this->salaryService->getNetMonthlySalary();
        $allOperations['net_monthly_salary'] = $monthlySalary;

        //regarde dans quelle tranche se situe le salaire
        // commence à regarder dans quelle tranche est le salaire


        //dd($grossMonthlySalary);

        return view('welcome', ['operations' => $allOperations]);

    }
}
