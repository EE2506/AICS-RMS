<?php


namespace App\Livewire\User;

use App\Models\UserActivityLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;

class Logs extends Component
{
    use WithPagination;
    public $logs;


    public function mount()
    {
        $this->logs = UserActivityLog::where('user_id', Auth::id())
                                      ->orderBy('created_at', 'desc')
                                      ->get();
    }

    public function render()
    {
        return view('livewire.user.logs', ['logs' => $this->logs])->layout('layouts.user-app');
    }
}
