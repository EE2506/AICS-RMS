<?php

namespace App\Http\Controllers;

use App\Models\UserActivityLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LogController extends Controller
{
    /**
     * Show the activity logs for the authenticated user.
     *
     * @return \Illuminate\View\View
     */
    public function showLogs()
    {
        // Fetch logs for the currently authenticated user, ordered by the most recent
        $logs = UserActivityLog::where('user_id', Auth::id())
                               ->orderBy('created_at', 'desc')
                               ->get();

        // Return the logs to a dedicated view for display
        return view('livewire.user.logs', compact('logs'));
    }
}
