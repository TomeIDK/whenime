<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ScheduleItemTooltip extends Component
{
    public $img;
    public $title;
    public $rank;
    public $score;
    public $services;
    /**
     * Create a new component instance.
     */
    public function __construct($img, $title, $rank, $score, $services)
    {
        $this->img = $img;
        $this->title = $title;
        $this->rank = $rank;
        $this->score = $score;
        $this->services = $services;

    }
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.schedule-item-tooltip');
    }
}
