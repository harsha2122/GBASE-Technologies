<?php

namespace App\View\Components;

use App\Models\PageSection;
use Illuminate\View\Component;
use Illuminate\View\View;

class CardGrid extends Component
{
    public function __construct(public PageSection $section)
    {
    }

    public function render(): View
    {
        return view('components.card-grid');
    }
}
