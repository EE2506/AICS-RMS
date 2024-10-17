<?php

namespace App\Livewire\User;
use Illuminate\Support\Facades\DB;
use Livewire\Component;
use Livewire\WithPagination; // Add this import for pagination
use App\Models\Client; // Import the Client model
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AICSExport; // Ensure this namespace matches your file structure

class ReportingTable extends Component
{
    use WithPagination;
    public function export()
    {
        // Create an instance of AICSExport and download the file
        return Excel::download(new AICSExport, 'AICS-Reporting-' . now()->format('Y-m-d') . '.xlsx');
    }
    public $clients = []; // To store the list of clients

    //Table 1 Var
    public $totals = [];
    public $counts = [];


    //Table 5 Var
    public $maleReferralCount, $femaleReferralCount, $maleWalkInCount, $femaleWalkInCount, $WalkInTotal, $ReferralTotal;
    //table 6 Variables
    public $onsiteMaleCount,$onsiteFemaleCount, $onsiteTotal, $onsiteMaleAmount, $onsiteFemaleAmount, $onsiteTotalAmount;
    public $offsiteMaleCount,$offsiteFemaleCount,$offsiteTotal, $offsiteMaleAmount, $offsiteFemaleAmount, $offsiteTotalAmount;
    public $malasakitMaleCount, $malasakitFemaleCount, $malasakitTotal, $malasakitMaleAmount, $malasakitFemaleAmount, $malasakitTotalAmount;
    public function mount($clients = [])
    {
        //
        $this->clients = $clients; // Initialize the clients from the parent component or controller
        $this->calculateTotalsGenderCounterTable1();
        //Table 5
        $this->countPeopleTable5();
        //TABLE 6
        // Onsite counts and amounts
        $this->onsiteMaleCount = Client::whereRaw("LOWER(REPLACE(through, '-', '')) = 'onsite'")
                                    ->where('sex', 'MALE')->count();
        $this->onsiteFemaleCount = Client::whereRaw("LOWER(REPLACE(through, '-', '')) = 'onsite'")
                                        ->where('sex', 'FEMALE')->count();
        $this->onsiteTotal = $this->onsiteMaleCount + $this->onsiteFemaleCount;

        $this->onsiteMaleAmount = Client::whereRaw("LOWER(REPLACE(through, '-', '')) = 'onsite'")
                                        ->where('sex', 'MALE')->sum('amount1');
        $this->onsiteFemaleAmount = Client::whereRaw("LOWER(REPLACE(through, '-', '')) = 'onsite'")
                                        ->where('sex', 'FEMALE')->sum('amount1');
        $this->onsiteTotalAmount = $this->onsiteMaleAmount + $this->onsiteFemaleAmount;

         //Offsite counts and amounts
        $this->offsiteMaleCount = Client::whereRaw("LOWER(REPLACE(through, '-', '')) = 'offsite'")
                                    ->where('sex', 'MALE')->count();
        $this->offsiteFemaleCount = Client::whereRaw("LOWER(REPLACE(through, '-', '')) = 'offsite'")
                                        ->where('sex', 'FEMALE')->count();
        $this->offsiteTotal = $this->offsiteMaleCount + $this->offsiteFemaleCount;

        $this->offsiteMaleAmount = Client::whereRaw("LOWER(REPLACE(through, '-', '')) = 'offsite'")
                                        ->where('sex', 'MALE')->sum('amount1');
        $this->offsiteFemaleAmount = Client::whereRaw("LOWER(REPLACE(through, '-', '')) = 'offsite'")
                                        ->where('sex', 'FEMALE')->sum('amount1');
        $this->offsiteTotalAmount = $this->offsiteMaleAmount + $this->offsiteFemaleAmount;

        // Malasakit counts and amounts
        $this->malasakitMaleCount = Client::whereRaw("LOWER(REPLACE(through, '-', '')) = 'malasakit'")
                                        ->where('sex', 'MALE')->count();
        $this->malasakitFemaleCount = Client::whereRaw("LOWER(REPLACE(through, '-', '')) = 'malasakit'")
                                        ->where('sex', 'FEMALE')->count();
        $this->malasakitTotal = $this->malasakitMaleCount + $this->malasakitFemaleCount;

        $this->malasakitMaleAmount = Client::whereRaw("LOWER(REPLACE(through, '-', '')) = 'malasakit'")
                                        ->where('sex', 'MALE')->sum('amount1');
        $this->malasakitFemaleAmount = Client::whereRaw("LOWER(REPLACE(through, '-', '')) = 'malasakit'")
                                            ->where('sex', 'FEMALE')->sum('amount1');
        $this->malasakitTotalAmount = $this->malasakitMaleAmount + $this->malasakitFemaleAmount;
    }
    public function calculateTotalsGenderCounterTable1()
    {
        $totals = [
            'FAMILY_HEADS_AND_OTHER_NEEDY_ADULT' => [
                'MALE' => ['18-29' => 0, '30-44' => 0, '45-59' => 0],
                'FEMALE' => ['18-29' => 0, '30-44' => 0, '45-59' => 0]
            ],
            'MEN/WOMEN_IN_SPECIALLY_DIFFICULT_CIRCUMSTANCES' => [
                'MALE' => ['18-29' => 0, '30-44' => 0, '45-59' => 0],
                'FEMALE' => ['18-29' => 0, '30-44' => 0, '45-59' => 0]
            ],
        'SENIOR_CITIZENS' && 'SENIOR_CITIZENS (NO_SUBCATEGORIES)' => [
                'MALE' => ['60-70' => 0, '71-79' => 0, '80+' => 0],
                'FEMALE' => ['60-70' => 0, '71-79' => 0, '80+' => 0]
            ],
            'CHILDREN_IN_NEED_OF_SPECIAL_PROTECTION' => [
                'MALE' => ['0-13' => 0, '14-17' => 0],
                'FEMALE' => ['0-13' => 0, '14-17' => 0]
            ],
            'YOUTH' => [
                'MALE' => ['18-30' => 0],
                'FEMALE' => ['18-30' => 0]
            ],
            'PERSONS_WITH_DISABILITIES' => [
                'MALE' => ['0-13' => 0, '14-17' => 0, '18-29' => 0, '30-44' => 0, '45-59' => 0, '60-70' => 0, '71-79' => 0, '80+' => 0],
                'FEMALE' => ['0-13' => 0, '14-17' => 0, '18-29' => 0, '30-44' => 0, '45-59' => 0, '60-70' => 0, '71-79' => 0, '80+' => 0]
            ],
            'PERSONS_LIVING_WITH_HIV/AIDS' => [
                'MALE' => ['0-13' => 0, '14-17' => 0, '18-29' => 0, '30-44' => 0, '45-59' => 0, '60-70' => 0, '71-79' => 0, '80+' => 0],
                'FEMALE' => ['0-13' => 0, '14-17' => 0, '18-29' => 0, '30-44' => 0, '45-59' => 0, '60-70' => 0, '71-79' => 0, '80+' => 0]
            ],
        ];

        $counts = $totals; // For counting entries

        // Loop through the clients and calculate totals and counts
        foreach ($this->clients as $clients) {
            $category = $clients['client_category'];
            $age = $clients['age'];
            $sex = strtoupper($clients['sex']); // 'MALE' or 'FEMALE'
            $amount = $clients['amount1'];

            // Determine age group and increment totals/counts based on category and gender
            $ageGroup = $this->getAgeGroup($category, $age);

            if ($ageGroup && isset($totals[$category][$sex][$ageGroup])) {
                $totals[$category][$sex][$ageGroup] += $amount;
                $counts[$category][$sex][$ageGroup] += 1;
            }
        }

        $this->totals = $totals;
        $this->counts = $counts;
    }

    private function getAgeGroup($category, $age)
    {
        switch ($category) {
            case 'FAMILY HEADS AND OTHER NEEDY ADULT':
            case 'MEN/WOMEN IN SPECIALLY DIFFICULT CIRCUMSTANCES':
                if ($age >= 18 && $age <= 29) return '18-29';
                if ($age >= 30 && $age <= 44) return '30-44';
                if ($age >= 45 && $age <= 59) return '45-59';
                break;
            case 'SENIOR CITIZENS' && 'SENIOR CITIZENS (NO SUBCATEGORIES)':
                if ($age >= 60 && $age <= 70) return '60-70';
                if ($age >= 71 && $age <= 79) return '71-79';
                if ($age >= 80) return '80+';
                break;
            case 'CHILDREN IN NEED OF SPECIAL PROTECTION':
                if ($age >= 0 && $age <= 13) return '0-13';
                if ($age >= 14 && $age <= 17) return '14-17';
                break;
            case 'YOUTH':
                if ($age >= 18 && $age <= 30) return '18-30';
                break;
            case 'PERSONS WITH DISABILITIES':
            case 'PERSONS LIVING WITH HIV AIDS':
                if ($age >= 0 && $age <= 13) return '0-13';
                if ($age >= 14 && $age <= 17) return '14-17';
                if ($age >= 18 && $age <= 29) return '18-29';
                if ($age >= 30 && $age <= 44) return '30-44';
                if ($age >= 45 && $age <= 59) return '45-59';
                if ($age >= 60 && $age <= 70) return '60-70';
                if ($age >= 71 && $age <= 79) return '71-79';
                if ($age >= 80) return '80+';
                break;
        }
        return null;
    }

    public function countPeopleTable5()
    {
        // Count for REFERRAL (case-insensitive and removing hyphens)
        $this->maleReferralCount = Client::where('mode_of_admission', 'REFERRAL')
        ->where('sex', 'MALE')
        ->count();

    $this->femaleReferralCount = Client::where('mode_of_admission', 'REFERRAL')
        ->where('sex', 'FEMALE')
        ->count();

    $this->maleWalkInCount = Client::where('mode_of_admission', 'WALK-IN')
        ->where('sex', 'MALE')
        ->count();

    $this->femaleWalkInCount = Client::where('mode_of_admission', 'WALK-IN')
        ->where('sex', 'FEMALE')
        ->count();

        $this->ReferralTotal = $this->femaleReferralCount + $this->maleReferralCount;
        $this->WalkInTotal = $this-> femaleWalkInCount= $this->maleWalkInCount;
    }





public function render()
{
    $clients = Client::all();

  //  dd($clients); // This will dump the paginated clients data

    return view('livewire.user.reporting',['clients' => $clients]) ->layout('layouts.user-app');
}

}
