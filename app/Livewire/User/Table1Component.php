<?php

namespace App\Livewire\User;

use Livewire\Component;

class Table1Component extends Component
{
    public function render()
    {
        return view('livewire.table1-component')->layout('layouts.user-app');
    }
}
