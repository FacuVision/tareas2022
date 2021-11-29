<?php

namespace App\Http\Livewire;

use App\Models\Actividad;
use Livewire\Component;
use App\Models\Tarea;
use App\Models\Respuesta;
use Illuminate\Support\Facades\Auth;

class ShowTarea extends Component
{
    public $showtarea = false;
    public $show = false;
    public $descripcion = [];
    public $dato;
    public $validado;
    // public $validcount;
    // public $actcount;
    // protected $rules = [
    //     'descripcion.*' => 'required',
    // ];

    public function render()
    {
        return view('livewire.show-tarea');
    }

    public function showtarea()
    {

        $this->showtarea = true;
    }

    public function enviar()
    {
        $actcount =0;
        $this->validado = $this->validate([
            'descripcion.*' => 'required'
        ]);
        // $this->validcount = count($this->validado);
        // $this->actcount = count($this->dato->actividades);
        // $actcount = count($this->dato->actividades);
        $validcount = count($this->validado['descripcion']);
        foreach ($this->dato->actividades as $act) {
            if($act->tipo != 3){
                $actcount++;
            }
        }

        if ($validcount == $actcount) {
            foreach ($this->descripcion as $id => $desc) {
                Respuesta::create([
                    "descripcion" => $desc,
                    "actividad_id" => $id,
                    "user_id" => Auth::user()->id
                ]);
            }
            $this->reset(['descripcion']);
            $this->emit('render');
            $this->showtarea = false;
        }

        // if($validado = true){
        //     $this->showtarea = false;
        // }


    }
    // public function show()
    // {

    //     $this->validado = $this->validate([
    //         'descripcion.*' => 'required'
    //     ]);

    //     $validcount = count($this->validado);
    //     $actcount = count($this->dato->actividades);
    //     if ($validcount = $actcount) {
    //         $this->show = true;
    //     }
    // }
}
