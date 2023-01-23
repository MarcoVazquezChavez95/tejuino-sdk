<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Modal extends Component
{

    public $action;
    public $id;
    public $title;
    public $icon;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($action = 'create', $id = 'modalCreate', $title = '', $icon = '')
    {
        $this->action = $action;
        $this->id = $id;
        $this->title = $title;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('admin.base.components.modal');
    }
}
