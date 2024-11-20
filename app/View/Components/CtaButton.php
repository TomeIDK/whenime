<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CtaButton extends Component
{
    public $text;
    public $id;
    public $class;
    /**
     * Create a new component instance.
     */
    public function __construct($text, $id = '', $class = '')
    {
        $this->text = $text;
        $this->id = $id;
        $this->class = $class;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cta-button');
    }
}
