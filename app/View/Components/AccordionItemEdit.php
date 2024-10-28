<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class AccordionItemEdit extends Component
{
    public $questionId;
    public $title;
    public $content;
    /**
     * Create a new component instance.
     */
    public function __construct($questionId, $title, $content)
    {
        $this->questionId = $questionId;
        $this->title = $title;
        $this->content = $content;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.accordion-item-edit');
    }
}
