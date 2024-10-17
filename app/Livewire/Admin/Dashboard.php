<?php

namespace App\Livewire\Admin;

use App\Models\Document;
use App\Models\User;
use Livewire\Component;
use App\Models\Recycle;

class Dashboard extends Component
{
    public $totalUser, $totalDocument, $approveUser;
    public $totalAdministrative;
    public $totalDue; // Add this property

    public function render()
    {
        $this->totalUser = User::count();
        $this->totalDocument = Document::count();
        $this->approveUser = User::where('remember_token', 1)->count();
        $this->totalAdministrative = Document::where('filetype', 'like', '%Administrative%')->count();


        return view('livewire.admin.dashboard')
            ->layout('layouts.admin-app');
    }
}
