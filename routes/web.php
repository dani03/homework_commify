<?php

use App\Http\Controllers\SalaryController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('store/salary',SalaryController::class)->name('store.salary');
