<?php

namespace App\Models;

use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaxRate extends Model
{
    /** @use HasFactory<UserFactory> */
    use HasFactory;

    protected $fillable = ["name", "percent", "range", 'annual_salary_range', 'identifier'];



}
