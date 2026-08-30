<?php

namespace App\View\Components;

use App\Models\Card as CardModel;
use Illuminate\View\Component;
use Illuminate\View\View;

class Card extends Component
{
    public function __construct(public CardModel $card)
    {
    }

    public function render(): View
    {
        return view('components.card');
    }
}
