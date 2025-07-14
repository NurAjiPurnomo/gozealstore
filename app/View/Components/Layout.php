<?php

namespace App\View\Components;

use App\CmsTrait;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Layout extends Component
{
    use CmsTrait;

    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view($this->default_template().'.components.layout', [
            'themeFolder' => $this->default_template(),
        ]);
    }
}
