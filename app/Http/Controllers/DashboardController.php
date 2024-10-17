<?php
namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch total number of served clients
        $totalClients = Client::count();

        // Fetch total amount of assistance
        $totalAmountAssistance = Client::sum('amount1'); // Assuming amount1 is the key for total amount

        // Fetch most requested assistance type
        $mostRequestedAssistance = Client::select('type_of_assistance1')
            ->groupBy('type_of_assistance1')
            ->orderByRaw('COUNT(*) DESC')
            ->limit(1)
            ->pluck('type_of_assistance1')
            ->first();

        // Prepare data array for view
        $data = [
            'total_clients' => $totalClients,
            'total_amount' => $totalAmountAssistance,
            'most_requested' => $mostRequestedAssistance,
        ];

            // Additional data for the dashboard
            $data = [

                'assistance_distribution' => [
                    'medical' => [
                        'female' => 1465654,
                        'male' => 1390700,
                    ],
                    'funeral' => [
                        'female' => 261400,
                        'male' => 174000,
                    ],
                    'food' => [
                        'female' => 143850,
                        'male' => 58000,
                    ],
                ],
                'pie_charts' => [
                    'type_of_assistance' => [
                        'medical' => 2856355,
                        'funeral' => 435400,
                        'food' => 201850,
                    ],
                    'sex_distribution' => [
                        'female' => 120,
                        'male' => 71,
                    ],
                ],
            ];

            // Pass data to the view
            return view('dashboard', compact('data'));
        }
    }
