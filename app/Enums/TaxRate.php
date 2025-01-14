<?php

namespace App\Enums;

enum TaxRate: int
{
    case taxBandA = 0;
    case taxBandB = 20;
    case taxBandC = 40;

    public function label(): string
    {
        return match ($this) {
            self::taxBandA => 'tax band A',
            self::taxBandB => 'tax band B',
            self::taxBandC => 'tax band C',
        };
    }

    public function taxBandRange(): int
    {
        return match ($this) {
            self::taxBandA => 5000,
            self::taxBandB => 20000,
            self::taxBandC => 20000,
        };

    }
}
