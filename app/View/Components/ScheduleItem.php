<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ScheduleItem extends Component
{
    public $name;
    public $service;
    public $animeid;
    /**
     * Create a new component instance.
     */
    public function __construct($name, $service, $animeid)
    {
        $this->name = $name;
        $this->service = $service;
        $this->animeid = $animeid;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.schedule-item');
    }
}
