<?php

namespace App\Http\Livewire;

use App\Models\Level;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ExpBar extends Component
{

    public function render()
    {
        $level = Level::where("user_id", Auth::user()->id)->first();
        $limite = ( $level->level * 100 );
        $avg = ($level->exp * 100)/$limite;
        return view('livewire.exp-bar', compact('level','avg','limite'));
    }
}
