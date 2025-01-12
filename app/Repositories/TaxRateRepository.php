<?php

namespace App\Repositories;

use App\Interfaces\TaxRateInterface;
use App\Models\TaxRate;
use Illuminate\Support\Collection;

class TaxRateRepository implements TaxRateInterface
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    public function allTaxes(): Collection | null
    {
        return TaxRate::all();
    }

    public function taxBandA(): TaxRate | null
    {
        return TaxRate::where('identifier', 'A')->first();
    }

    public function taxBandB(): TaxRate | null
    {
        return TaxRate::where('identifier', 'B')->first();
    }

    public function taxBandC(): TaxRate | null
    {
        return TaxRate::where('identifier', 'C')->first();
    }


}
