<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ScheduleItem extends Component
{
    public $name;
    public $service;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $service)
    {
        $this->name = $name;
        $this->service = $service;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.schedule-item');
    }
}
