<?php

namespace App\Interfaces;

use App\Models\TaxRate;

interface TaxRateInterface
{
    //
    public function taxBandA(): ?TaxRate;

    public function taxBandB(): ?TaxRate;

    public function taxBandC(): ?TaxRate;
}
