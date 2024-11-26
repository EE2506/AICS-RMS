<?php

namespace App\Livewire\Admin;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class ApproveUser extends Component
{
    use WithPagination;

    public $totalUser;

    protected $listeners = ['refreshUsers' => '$refresh'];

    public function mount()
    {
        $this->totalUser = User::count();
    }

    public function approve($userId)
    {
        $user = User::find($userId);
        if ($user && $user->custom_token != 1) {
            $user->custom_token = 1;
            $user->save();

            // Flash success message
            session()->flash('success', 'User approved successfully.');

            // Update total user count
            $this->totalUser = User::count();

            // Emit the refresh event
            $this->dispatch('refreshUsers'); // Correct usage of emit
        }
    }

    public function toggleStatus($userId)
    {
        $user = User::find($userId);
        if ($user) {
            $user->custom_token = $user->custom_token == 1 ? 0 : 1;
            $user->save();

            $status = $user->custom_token == 1 ? 'activated' : 'disabled';

            // Flash success message
            session()->flash('success', "User has been {$status}.");

            // Emit the refresh event
            $this->dispatch('refreshUsers'); // Correct usage of emit
        }
    }

    public function render()
    {
        return view('livewire.admin.approve-user', [
            'users' => User::orderBy('id', 'asc')->paginate(10),
            'totalUser' => $this->totalUser
        ])->layout('layouts.admin-app');
    }
}
