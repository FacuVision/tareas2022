<?php

namespace App\View\Components;

use App\Models\Mensaje;
use Illuminate\View\Component;

class MensajeComponent extends Component
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
        $mensaje = Mensaje::all()->random();
        return view('components.mensaje-component', compact('mensaje'));
    }
}
