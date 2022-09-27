<?php

namespace App\Http\Livewire;

use App\Models\Actividad;
use Livewire\Component;
use App\Models\Tarea;
use App\Models\Respuesta;
use App\Models\Alumno;
use Carbon\Carbon;
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
        //$this->emit('timenow');

    }


    public function enviar()
    {


        $this->validado = $this->validate([
            'descripcion.*' => 'required'
        ]);

            foreach ($this->descripcion as $id => $desc) {
                Respuesta::create([
                    "descripcion" => $desc,
                    "actividad_id" => $id,
                    "user_id" => Auth::user()->id
                ]);
            }

            //AQUI VA EL UPDATE PARA CAMBIAR EL ESTADO DE LA TAREA EN ALUMNO-TAREA A 1 = RESUELTO
            $alumno = Alumno::findOrFail(Auth()->user()->id);
            $tarea = $alumno->tareas->find($this->dato->id);
            $start = $tarea->pivot->hora_inicio;
            $end = Carbon::now('America/Lima');
            //$elap = $end->diffInHours($start, false);
            $elap = $end->diffInSeconds($start);
            //$alumno->sync([$this->dato->id =>['estado' => '1']]);   NO FUNKO
            //$alumno->tareas()->detach($this->dato->id);                   X2
            //$alumno->tareas()->attach($this->dato->id,['estado' => '1']); X3

            $alumno->tareas()->updateExistingPivot($this->dato->id,['estado' => '1','hora_final' => $end, "segundos_pasados" => $elap ]);

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




        // if($validado = true){
        //     $this->showtarea = false;
        // }


    }

    //   public function show()
    //   {


    //       $this->show = true;
    //   }
}
