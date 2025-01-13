<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreTaxRequest;
use App\Services\TaxService;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class TaxController extends Controller
{
    public function __construct(private TaxService $taxService)
    {
    }

    public function index(): View
    {
        return view('taxes.show');
    }

    public function store(StoreTaxRequest $request): RedirectResponse
    {
        $this->taxService->saveNewTaxRate($request);
        return redirect()->route('home')->with(['success' =>'A new tax has been added']);


    }
}
