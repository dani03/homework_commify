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
        $percent = is_numeric($request->percent) ? (int) $request->percent : 0;
        $annual_salary_range = is_numeric($request->annual_band) ? (int) $request->annual_band : 0;
        $name = is_string($request->name) ? (string) $request->name : '';
            $data = [
            'range' => is_string($request->range) ? (string) $request->range : '',
            'percent' => $percent,
            'annual_salary_range' => $annual_salary_range,
            'name' => $name,
            'identifier' => Str::ulid()
        ];

       return  $this->taxRateRepository->save($data);
    }


}
