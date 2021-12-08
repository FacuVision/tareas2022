<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Alumno;
use App\Models\Respuesta;
use Illuminate\Support\Facades\Auth;
class ShowRespuesta extends Component
{

    public $show = false;
    public $dato;
    public $res = [];


    public function render()
    {
        return view('livewire.show-respuesta');
    }

    public function show()
    {

        $this->res = Respuesta::where('user_id',Auth::user()->id)->get();


        $this->show = true;
    }
}
