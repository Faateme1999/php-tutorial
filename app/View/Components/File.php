<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class File extends Component
{
    public $placeholder;

    public $name;

    /**
     * @var null
     */
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($placeholder, $name, $value = null)
    {
        $this->placeholder = $placeholder;
        $this->name = $name;
        $this->value = $value;
    }

    public function render(): View|Closure|string
    {
        return view('components.file');
    }
}
