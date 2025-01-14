<?php

namespace App\Repositories;

use App\Interfaces\TaxRateInterface;
use App\Models\TaxRate;
use Illuminate\Support\Collection;
use Symfony\Component\Uid\Ulid;

class TaxRateRepository implements TaxRateInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * @return Collection<int, TaxRate>|null
     */
    public function allTaxes(): ?Collection
    {
        return TaxRate::all()->sortBy('percent');
    }

    public function taxBandA(): ?TaxRate
    {
        return TaxRate::where('identifier', 'A')->first();
    }

    public function taxBandB(): ?TaxRate
    {
        return TaxRate::where('identifier', 'B')->first();
    }

    public function taxBandC(): ?TaxRate
    {
        return TaxRate::where('identifier', 'C')->first();
    }

    /**
     * Save a new TaxRate.
     *
     * @param array{identifier: Ulid, range: string,
     *     percent: integer, name:string, annual_salary_range: integer} $data
     */
    public function save(array $data): bool
    {
        return (bool) TaxRate::create($data);
    }
}
