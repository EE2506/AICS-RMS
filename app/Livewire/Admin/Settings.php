<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Illuminate\Support\Facades\Hash;
use App\Models\Value;
use App\Models\Value1;

class Settings extends Component
{
    public $currentPassword;
    public $newPassword;
    public $confirmNewPassword;


    public function render()
    {
        return view('livewire.admin.settings')->layout('layouts.admin-app');
    }

    public function changePassword()
    {
        $this->validate([
            'currentPassword' => 'required',
            'newPassword' => 'required|min:8|max:12|different:currentPassword',
            'confirmNewPassword' => 'required|same:newPassword|max:12',
        ]);

        // Check if the current password matches the authenticated user's password
        if (!Hash::check($this->currentPassword, auth()->user()->password)) {
            $this->addError('currentPassword', 'The current password is incorrect.');
            return;
        }

        // Update the user's password
        auth()->user()->update([
            'password' => bcrypt($this->newPassword),
        ]);

        // Reset the form fields
        $this->currentPassword = '';
        $this->newPassword = '';
        $this->confirmNewPassword = '';

        session()->flash('message', 'Password changed successfully!');
    }

}
