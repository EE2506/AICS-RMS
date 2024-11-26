<?php

namespace App\Livewire\Admin;

use App\Models\Client;
use App\Models\User;
use App\Models\UserActivityLog;
use Livewire\Component;

class Dashboard extends Component
{
    public $totalUser, $activeUser, $inactiveUser, $logs;
    public $activityDates = [], $activityCounts = [];
    public $search, $startDate, $endDate;

    public function render()
    {
        $this->totalUser = User::count();
        $this->activeUser = User::where('custom_token', 1)->count();
        $this->inactiveUser = User::where('custom_token', 0)->count();


        // Fetch activity trend data
        $activities = UserActivityLog::select(
            Client::raw('DATE(created_at) as date'),
            Client::raw('count(*) as count')
        )
        ->groupBy('date')
        ->orderBy('date', 'asc')
        ->get();

        $this->activityDates = $activities->pluck('date')->toArray();
        $this->activityCounts = $activities->pluck('count')->toArray();

        return view('livewire.admin.dashboard')
            ->layout('layouts.admin-app');
    }

public function getLogsProperty()
{
    $query = UserActivityLog::query();


    if ($this->startDate) {
        $query->whereDate('created_at', '>=', $this->startDate);
    }

    if ($this->endDate) {
        $query->whereDate('created_at', '<=', $this->endDate);
    }

    return $query->latest()->paginate(10);
}
}

