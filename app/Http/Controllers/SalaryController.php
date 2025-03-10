<?php

namespace App\Http\Controllers;

use App\Http\Requests\SalaryRequest;
use App\Services\SalaryService;
use Symfony\Component\HttpFoundation\RedirectResponse;

class SalaryController extends Controller
{
    public function __construct(private readonly SalaryService $salaryService) {}

    public function __invoke(SalaryRequest $request): RedirectResponse
    {
        $salary = $request->salary;
        $salary = is_numeric($salary) ? (int) $salary : 0;
        $this->salaryService->setGrossAnnualSalary($salary);
        $salaryDetails = $this->salaryService->allSalaryDetails();

        return redirect()->back()->with([
            'success' => 'This is the details of your salary. ',
            'salaryDetails' => $salaryDetails,

        ]);

    }
}
