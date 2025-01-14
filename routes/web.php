<?php

use App\Http\Controllers\SalaryController;
use App\Http\Controllers\TaxController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::post('store/salary', SalaryController::class)->name('store.salary');
Route::get('add/band', [TaxController::class, 'index'])->name('show.tax');
Route::post('store/band', [TaxController::class, 'store'])->name('store.tax');
