<?php

namespace App\View\Components;

use Illuminate\View\Component;

class Panel extends Component
{

    public $id;
    public $title;
    public $light;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($id = 'panel', $title = '', $light = false)
    {
        $this->id = $id;
        $this->title = $title;
        $this->light = $light;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('admin.base.components.panel');
    }
}
