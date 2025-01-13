<?php

namespace App\Services;

use App\Http\Requests\StoreTaxRequest;
use App\Repositories\TaxRateRepository;
use Illuminate\Support\Str;

class TaxService
{
    /**
     * Create a new class instance.
     */
    public function __construct(private TaxRateRepository $taxRateRepository)
    {

    }

    public function saveNewTaxRate(StoreTaxRequest $request): bool
    {
       $data = [
           'identifier' => Str::ulid(),
            'range' => $request->range,
            'name' => $request->name,
            'percent' => $request->percent,
            'annual_salary_range' => $request->annual_band
        ];

       return  $this->taxRateRepository->save($data);


    }


}
