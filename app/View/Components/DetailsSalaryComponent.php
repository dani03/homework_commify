<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class DetailsSalaryComponent extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  Collection<int, string>  $details
     */
    public function __construct(public Collection $details)
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.details-salary-component');
    }
}
