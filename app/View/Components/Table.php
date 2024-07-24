<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Table extends Component
{
    public $title;
    public $headers;
    public $items;
    public $addRoute;
    public $actions;

    /**
     * Create a new component instance.
     */
    public function __construct($title, $headers, $items, $addRoute = null, $actions = [])
    {
        $this->title = $title;
        $this->headers = $headers;
        $this->items = $items;
        $this->addRoute = $addRoute;
        $this->actions = $actions;
    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.table');
    }
}
