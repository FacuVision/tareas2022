<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Tarea;
use App\Models\Respuesta;
use Illuminate\Support\Facades\Auth;

class ShowTarea extends Component
{
    public $showtarea = false;
    // public $show = false;
    public $descripcion = [];
    public $dato;
    public function render()
    {
        return view('livewire.show-tarea');
    }

    public function showtarea(){

        $this->showtarea = true;

    }

    public function enviar(){

        foreach ($this->descripcion as $id => $desc) {
            Respuesta::create([
                "descripcion" => $desc,
                "actividad_id" => $id,
                "user_id" => Auth::user()->id
            ]);
        }
        $this->showtarea = false;


    }
    // public function show (){

    //     $this->show = true;
    // }
}
