<?php

namespace App\Http\Livewire;

use App\Models\Level;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExpBar extends Component
{
    //public $level;
    public $exp;
    public $lvl;
    public $limite;
    public $avg;
    public $exp_ac;

    public function render()
    {

        $level = Level::where("user_id", Auth::user()->id)->first();
        $this->exp_ac=$level->exp_ac;
        $this->exp = $level->exp;
        $this->lvl = $level->level;
        $this->limite = ( $level->level * 100 );
        $this->avg = ($this->exp * 100)/$this->limite;
        return view('livewire.exp-bar');
    }
}
