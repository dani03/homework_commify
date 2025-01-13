<?php


use App\Actions\SalaryAction;
use App\Repositories\TaxRateRepository;
use App\Services\SalaryService;

it('returns a successful response', function () {
    $response = $this->get('/');

    $response->assertStatus(200);
});

it('can retrieve a gross salary', function() {
        $salaryService = new SalaryService(new SalaryAction(new TaxRateRepository()));
        $salaryService->setGrossAnnualSalary(40000);
        $salary = $salaryService->getGrossAnnualSalary();

        expect($salary)->toBe(40000);
});

it('annual tax paid is good', function() {
    $salaryService = new SalaryService(new SalaryAction(new TaxRateRepository()));
    $salaryService->setGrossAnnualSalary(40000);
    $salary = $salaryService->getAnnualTaxPaid();
    expect($salary)->toBe(11000.0);
});


