<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TaxRate extends Model
{
    use HasFactory;

    protected $fillable = ["name", "percent", "range", 'annual_salary_range', 'identifier'];

    public function salaries(): HasMany
    {
        return $this->hasMany(Salary::class);
    }

}
