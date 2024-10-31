<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NewsItem extends Component
{
    public $id;
    public $title;
    public $src;
    public $content;
    public $publishedDate;
    /**
     * Create a new component instance.
     */
    public function __construct($id, $title, $src, $content, $publishedDate)
    {
        $this->id = $id;
        $this->title = $title;
        $this->src = $src;
        $this->content = $content;
        $this->publishedDate = date("d/m/Y", strtotime($publishedDate));
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.news-item');
    }
}
