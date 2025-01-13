<?php

test('user can find a detail of his salary', function () {
    $response = $this->post('/store/salary', [
        'salary' => 40000
    ]);
    $response->assertRedirect('/');
    $response->assertSessionHas('salaryDetails', function ($details) {
        // Validate that the salary details contain the expected values
        return $details['grossAnnualSalary'] === 40000 &&  $details['annualTaxPaid']  === 11000.0;
    });
});


