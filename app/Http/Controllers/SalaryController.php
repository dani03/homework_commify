<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaryRequest;
use App\Services\SalaryService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SalaryController extends Controller
{
    public function __construct(private SalaryService $salaryService)
    {

    }

    public function __invoke(SalaryRequest $request): View
    {
        $salary =  $request->salary;
        $salary = is_numeric($salary) ? (int) $salary : 0;
        $this->salaryService->setGrossAnnualSalary($salary);
        $salaryDetails = $this->salaryService->allSalaryDetails();
        return view('welcome', compact('salaryDetails'));

    }
}
