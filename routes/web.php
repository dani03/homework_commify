<?php

use App\Http\Controllers\SalaryController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::post('store/salary',SalaryController::class)->name('store.salary');
