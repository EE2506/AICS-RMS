<?php

namespace App\Livewire\Admin;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Logout extends Component
{
    public function render()
    {
        return view('livewire.admin.logout');
    }
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('user.login'));
    }
}

