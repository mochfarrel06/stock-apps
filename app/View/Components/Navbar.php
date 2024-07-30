<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Navbar extends Component
{
    public $routeActive;
    public $routeLink;

    /**
     * Create a new component instance.
     */
    public function __construct($routeActive = null, $routeLink = null)
    {
        $this->routeActive = $routeActive;
        $this->routeLink = $routeLink;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.navbar');
    }
}
