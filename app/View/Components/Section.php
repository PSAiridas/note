<?php

namespace App\View\Components;

use App\Models\Category;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class Section extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $userid=Auth::user()->id;
        $cats = Category::orderBy('order')->where('user_id', $userid)->get();
        // $cats = Category::orderBy('order')->get();
        return view('components.section')->with("section", $cats);
    }
}
