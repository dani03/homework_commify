<?php

namespace App\Enums;

enum AnnualSalaryRange : int
{
    case rangeSalaryA = 5000;
    case rangeSalaryB = 20000;

    case taxBandA = 0;
    case taxBandB = 20;
    case taxBandC = 40;



    public function label(): string
    {
        return match ($this) {
            self::rangeSalaryA => 'tax band A',
            self::rangeSalaryB => 'tax band B',

        };
    }

    public static function allSalaryRange(): array
    {
        return [
            self::rangeSalaryA->value,
            self::rangeSalaryB->value,

        ];
    }
}
