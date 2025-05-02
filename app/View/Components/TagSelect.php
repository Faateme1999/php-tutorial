<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class TagSelect extends Component
{
    public $name;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name)
    {
        //
        $this->name = $name;
    }
    public function render(): View|Closure|string
    {
        return view('components.tag-select');
    }
}
