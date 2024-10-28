<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Link extends Component
{
    public $route;
    public $text;
    public $class;
    /**
     * Create a new component instance.
     */
    public function __construct($route, $text, $class = '')
    {
        $this->route = $route;
        $this->text = $text;
        $this->class = $class;

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.link');
    }
}
