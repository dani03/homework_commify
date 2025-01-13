<?php

namespace App\Interfaces;

use App\Models\TaxRate;

interface TaxRateInterface
{
    //
    public function taxBandA(): TaxRate | null;
    public function taxBandB(): TaxRate | null;
    public function taxBandC(): TaxRate | null;
}


