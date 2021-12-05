<?php

namespace App\Http\Livewire;

use App\Models\Actividad;
use Livewire\Component;
use App\Models\Tarea;
use App\Models\Respuesta;
use App\Models\Alumno;
use Illuminate\Support\Facades\Auth;

class ShowTarea extends Component
{
    public $showtarea = false;
    //public $show = false;
    public $descripcion = [];
    public $dato;
    public $validado;


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

        $actcount = 0;
        $this->validado = $this->validate([
            'descripcion.*' => 'required'
        ]);
        $validcount = count($this->validado['descripcion']);
        foreach ($this->dato->actividades as $act) {
            if ($act->tipo != 3) {
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
            //AQUI VA EL SYNC PARA CAMBIAR EL ESTADO DE LA TAREA EN ALUMNO-TAREA A 1 = RESUELTO
            $alumno = Alumno::findOrFail(Auth()->user()->id);
            //$alumno->tareas()->detach($this->dato->id);
            //$alumno->tareas()->attach($this->dato->id,['estado' => '1']);
            $alumno->tareas()->sync([$this->dato->id =>['estado' => '1']]);

            //ENVIAR UN NUEVO MODELO DONDE LLEVA LA CARPETA DONDE ESTA EL ALUMNO ACTUALMENTE.

            foreach ($alumno->tareas as $tarea) {
                if ($tarea->carpeta_id == $this->dato->carpeta_id) {
                    $carpeta = $tarea->carpeta;
                    break;
                }

            }
            $this->reset(['descripcion']);
            $this->showtarea = false;
            return redirect()->route('alumno.carpetas.show', compact('carpeta'))->with('mensaje_tarea', 'Tarea enviada correctamente');


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


    //     $this->show = true;
    // }
}
