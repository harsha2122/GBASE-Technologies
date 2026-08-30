<?php

namespace App\View\Components;

use App\Models\Form as FormModel;
use Illuminate\View\Component;
use Illuminate\View\View;

class DynamicForm extends Component
{
    public function __construct(public FormModel $form, public string $pageSource)
    {
    }

    public function render(): View
    {
        return view('components.dynamic-form');
    }
}
