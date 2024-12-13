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

    // table 2
    public $grandTotalFemale = 0;
    public $grandTotalMale = 0;
    public $grandTotalOverall = 0;


    //Table 5 Var
    public $maleReferralCount, $femaleReferralCount, $maleWalkInCount, $femaleWalkInCount, $WalkInTotal, $ReferralTotal, $GrandTotalMaleTable5, $GrandTotalFemaleTable5, $GrandTotalTable5;
    //table 6 Variables
    public $onsiteMaleCount,$onsiteFemaleCount, $onsiteTotal, $onsiteMaleAmount, $onsiteFemaleAmount, $onsiteTotalAmount;
    public $offsiteMaleCount,$offsiteFemaleCount,$offsiteTotal, $offsiteMaleAmount, $offsiteFemaleAmount, $offsiteTotalAmount;
    public $malasakitMaleCount, $malasakitFemaleCount, $malasakitTotal, $malasakitMaleAmount, $malasakitFemaleAmount, $malasakitTotalAmount;
    public $GrandTotalMaleTable6, $GrandTotalMaleAmountTable6, $GrandTotalFemaleTable6, $GrandTotalFemaleAmountTable6, $GrandTotalCountTable6, $GrandTotalAmountTable6;
    public function mount($clients = [])
    {
        //
        $this->clients = $clients; // Initialize the clients from the parent component or controller
        $this->calculateTotalsGenderCounterTable1();
        // table 2
        $this->AssistanceTable2();
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

            // Table 7
            $this->calculateAssistanceCounterTable7();

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

        $this->GrandTotalMaleTable6 = $this->onsiteMaleCount + $this->offsiteMaleCount + $this->malasakitMaleCount;

        $this->GrandTotalMaleAmountTable6 = $this->onsiteMaleAmount + $this->offsiteMaleAmount + $this->malasakitMaleAmount;

        $this->GrandTotalFemaleTable6 = $this->onsiteFemaleCount + $this->offsiteFemaleCount + $this->malasakitFemaleCount;

        $this->GrandTotalFemaleAmountTable6 = $this->onsiteFemaleAmount + $this->offsiteFemaleAmount + $this->malasakitFemaleAmount;

        $this->GrandTotalCountTable6 = $this->onsiteTotal + $this->offsiteTotal + $this->malasakitTotal;
        $this->GrandTotalAmountTable6 = $this->onsiteTotalAmount + $this->offsiteTotalAmount + $this->malasakitTotalAmount;

        $this->CalculateSubcategoryTable8();
        $this->typeofAssistancetable4();

    }

    public function calculateTotalsGenderCounterTable1()
{
    $totals = [
        'FAMILY HEADS AND OTHER NEEDY ADULT' => [
            'MALE' => ['18-29' => 0, '30-44' => 0, '45-59' => 0],
            'FEMALE' => ['18-29' => 0, '30-44' => 0, '45-59' => 0]
        ],
        'MEN/WOMEN IN SPECIALLY DIFFICULT CIRCUMSTANCES' => [
            'MALE' => ['18-29' => 0, '30-44' => 0, '45-59' => 0],
            'FEMALE' => ['18-29' => 0, '30-44' => 0, '45-59' => 0]
        ],
        'SENIOR CITIZENS' => [
            'MALE' => ['60-70' => 0, '71-79' => 0, '80+' => 0],
            'FEMALE' => ['60-70' => 0, '71-79' => 0, '80+' => 0]
        ],
        'SENIOR CITIZENS (NO SUBCATEGORIES)' => [
            'MALE' => ['60-70' => 0, '71-79' => 0, '80+' => 0],
            'FEMALE' => ['60-70' => 0, '71-79' => 0, '80+' => 0]
        ],
        'CHILDREN IN NEED OF SPECIAL PROTECTION' => [
            'MALE' => ['0-13' => 0, '14-17' => 0],
            'FEMALE' => ['0-13' => 0, '14-17' => 0]
        ],
        'YOUTH' => [
            'MALE' => ['18-30' => 0],
            'FEMALE' => ['18-30' => 0]
        ],
        'PERSONS WITH DISABILITIES' => [
            'MALE' => ['0-13' => 0, '14-17' => 0, '18-29' => 0, '30-44' => 0, '45-59' => 0, '60-70' => 0, '71-79' => 0, '80+' => 0],
            'FEMALE' => ['0-13' => 0, '14-17' => 0, '18-29' => 0, '30-44' => 0, '45-59' => 0, '60-70' => 0, '71-79' => 0, '80+' => 0]
        ],
        'PERSONS LIVING WITH HIV/AIDS' => [
            'MALE' => ['0-13' => 0, '14-17' => 0, '18-29' => 0, '30-44' => 0, '45-59' => 0, '60-70' => 0, '71-79' => 0, '80+' => 0],
            'FEMALE' => ['0-13' => 0, '14-17' => 0, '18-29' => 0, '30-44' => 0, '45-59' => 0, '60-70' => 0, '71-79' => 0, '80+' => 0]
        ],
    ];

    $counts = $totals; // For counting entries

    // Fetch clients from the database
    $clients = Client::all();

    // Loop through the clients and calculate totals and counts
    foreach ($clients as $client) {
        $category = $client->client_category;
        $age = $client->age;
        $sex = strtoupper($client->sex); // 'MALE' or 'FEMALE'
        $amount = $client->amount1;

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
        case 'SENIOR CITIZENS':
        case 'SENIOR CITIZENS (NO SUBCATEGORIES)':
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
        case 'PERSONS LIVING WITH HIV/AIDS':
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

    public $assistanceData = [];

    public function AssistanceTable2()
    {
        // Initialize an empty array to store the result
    $assistanceTotals = [];

    // Reset grand totals
    $this->grandTotalFemale = 0;
    $this->grandTotalMale = 0;
    $this->grandTotalOverall = 0;

    // Define the types of assistance you want to calculate
    $typesOfAssistance = [
        'EDUCATIONAL ASSISTANCE',
        'TRANSPORTATION ASSISTANCE',
        'BURIAL ASSISTANCE',
        'FOOD ASSISTANCE',
        'OTHER CASH ASSISTANCE',
        'HOT MEALS',
        'FAMILY FOOD PACKS',
        'HYGIENE AND SLEEPING KITS',
        'ASSISTIVE DEVICES AND TECHNOLOGIES',
        'PSYCHOSOCIAL',
        'REFERRAL',
    ];

    foreach ($typesOfAssistance as $assistanceType) {
        // Calculate total for FEMALE
        $femaleTotal = Client::where('type_of_assistance1', $assistanceType)
            ->where('sex', 'FEMALE')
            ->sum('amount1');

        // Calculate total for MALE
        $maleTotal = Client::where('type_of_assistance1', $assistanceType)
            ->where('sex', 'MALE')
            ->sum('amount1');

        // Calculate the combined total for both FEMALE and MALE
        $totalAmount = $femaleTotal + $maleTotal;

        // Store the totals in an array
        $assistanceTotals[$assistanceType] = [
            'FEMALE' => $femaleTotal,
            'MALE' => $maleTotal,
            'TOTAL' => $totalAmount,
        ];

        // Add to the grand totals
        $this->grandTotalFemale += $femaleTotal;
        $this->grandTotalMale += $maleTotal;
        $this->grandTotalOverall += $totalAmount;
    }

    // Assign the calculated totals to the component property
    $this->assistanceData = $assistanceTotals;
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

        $this->WalkInTotal = $this-> femaleWalkInCount + $this->maleWalkInCount;
        $this->ReferralTotal = $this->femaleReferralCount + $this->maleReferralCount;
        $this->GrandTotalMaleTable5 = $this->maleWalkInCount + $this->maleReferralCount;
        $this->GrandTotalFemaleTable5= $this->femaleReferralCount +$this-> femaleWalkInCount ;
        $this->GrandTotalTable5= $this->ReferralTotal + $this->WalkInTotal;
    }

    public function countGenderByCategoryTable3()
    {
        $categories = [
            'FAMILY HEADS AND OTHER NEEDY ADULT',
            'MEN/WOMEN IN SPECIALLY DIFFICULT CIRCUMSTANCES',
            'SENIOR CITIZENS', // We'll handle 'SENIOR CITIZENS' && 'SENIOR CITIZENS (NO SUBCATEGORIES)' together
            'CHILDREN IN NEED OF SPECIAL PROTECTION',
            'YOUTH',
            'PERSONS WITH DISABILITIES',
            'PERSONS LIVING WITH HIV AIDS'
        ];

        $genderCounts = [];
            // Variables to hold grand totals
        $grandTotalMale = 0;
        $grandTotalFemale = 0;
        $grandTotal = 0;

        foreach ($categories as $category) {
            // Special case for 'SENIOR CITIZENS' and 'SENIOR CITIZENS (NO SUBCATEGORIES)'
            if ($category === 'SENIOR CITIZENS') {
                $maleCountTable3 = \App\Models\Client::where(function ($query) {
                    $query->where('client_category', 'SENIOR CITIZENS')
                        ->orWhere('client_category', 'SENIOR CITIZENS (NO SUBCATEGORIES)');
                })->where('sex', 'MALE')->count();

                $femaleCountTable3 = \App\Models\Client::where(function ($query) {
                    $query->where('client_category', 'SENIOR CITIZENS')
                        ->orWhere('client_category', 'SENIOR CITIZENS (NO SUBCATEGORIES)');
                })->where('sex', 'FEMALE')->count();
            } else {
                // For other categories
                $maleCountTable3 = \App\Models\Client::where('client_category', $category)
                    ->where('sex', 'MALE')
                    ->count();

                $femaleCountTable3 = \App\Models\Client::where('client_category', $category)
                    ->where('sex', 'FEMALE')
                    ->count();
            }

            $totalCountTable3 = $maleCountTable3 + $femaleCountTable3;

            $genderCounts[$category] = [
                'male' => $maleCountTable3,
                'female' => $femaleCountTable3,
                'total' => $totalCountTable3
            ];
                   // Add to grand totals
        $grandTotalMale += $maleCountTable3;
        $grandTotalFemale += $femaleCountTable3;
        $grandTotal += $totalCountTable3;
    }

    // Add grand totals to the array
    $genderCounts['grand_total'] = [
        'male' => $grandTotalMale,
        'female' => $grandTotalFemale,
        'total' => $grandTotal];


        return $genderCounts;
    }

    public function typeofAssistancetable4()
{
   // Define the age groups and their corresponding ranges
    $ageGroups = [
    '0-13' => [0, 13],
    '14-17' => [14, 17],
    '18-29' => [18, 29],
    '30-44' => [30, 44],
    '45-59' => [45, 59],
    '60-70' => [60, 70],
    '71-79' => [71, 79],
    '80+' => [80, 150], // Assuming 150 as the upper limit
];

// List of types of assistance
$typesOfAssistance = [
    'EDUCATIONAL ASSISTANCE',
    'TRANSPORTATION ASSISTANCE',
    'BURIAL ASSISTANCE',
    'FOOD ASSISTANCE',
    'OTHER CASH ASSISTANCE',
    'HOT MEALS',
    'FAMILY FOOD PACKS',
    'HYGIENE AND SLEEPING KITS',
    'ASSISTIVE DEVICES AND TECHNOLOGIES',
    'PSYCHOSOCIAL',
    'REFERRAL',
];

// Prepare the clients data structure
$clients = [];

foreach ($typesOfAssistance as $type) {
    $row = ['type_of_assistance' => $type];
    $grandTotal = 0;

    foreach ($ageGroups as $group => [$minAge, $maxAge]) {
        // Fetch the male and female counts from the database
        $maleCount = Client::where('type_of_assistance1', $type)
            ->where('sex', 'Male')
            ->whereBetween('age', [$minAge, $maxAge])
            ->sum('amount1') ?? 0;

        $femaleCount = Client::where('type_of_assistance1', $type)
            ->where('sex', 'Female')
            ->whereBetween('age', [$minAge, $maxAge])
            ->sum('amount1') ?? 0;

        $totalCount = $maleCount + $femaleCount;

        // Set default values if no data is found
        $row["{$group}_male"] = $maleCount ?: 0;
        $row["{$group}_female"] = $femaleCount ?: 0;
        $row["{$group}_total"] = $totalCount ?: 0;

        $grandTotal += $totalCount;
    }

    $row['grand_total'] = $grandTotal ?: 0;

    $clients[] = $row;
}

$this->clients = $clients;
}

    //table 7
    public $assistanceCounterDataTable7 =[];
    public $grandTotalFemaleCountTable7 = 0;
    public $grandTotalMaleCountTable7 = 0;
    public $grandTotalCountTable7 = 0;

    public function calculateAssistanceCounterTable7()
    {
        // Initialize an empty array to store the result
        $counterTotals = [];

        // Reset grand totals
        $this->grandTotalFemaleCountTable7 = 0;
        $this->grandTotalMaleCountTable7 = 0;
        $this->grandTotalCountTable7 = 0;

        // Define the types of assistance you want to calculate
        $typesOfAssistance = [
            'EDUCATIONAL ASSISTANCE',
            'TRANSPORTATION ASSISTANCE',
            'BURIAL ASSISTANCE',
            'FOOD ASSISTANCE',
            'OTHER CASH ASSISTANCE',
            'HOT MEALS',
            'FAMILY FOOD PACKS',
            'HYGIENE AND SLEEPING KITS',
            'ASSISTIVE DEVICES AND TECHNOLOGIES',
            'PSYCHOSOCIAL',
            'REFERRAL',
        ];

        foreach ($typesOfAssistance as $assistanceType) {
            // Count individuals for FEMALE
            $femaleCount =Client::where('type_of_assistance1', $assistanceType)
                ->where('sex', 'FEMALE')
                ->count();

            // Count individuals for MALE
            $maleCount = Client::where('type_of_assistance1', $assistanceType)
                ->where('sex', 'MALE')
                ->count();

            // Calculate total for this type of assistance
            $totalCount = $femaleCount + $maleCount;

            // Store the counts in an array
            $counterTotals[$assistanceType] = [
                'FEMALE' => $femaleCount,
                'MALE' => $maleCount,
                'TOTAL' => $totalCount,
            ];

            // Add to the grand totals
            $this->grandTotalFemaleCountTable7 += $femaleCount;
            $this->grandTotalMaleCountTable7 += $maleCount;
            $this->grandTotalCountTable7 += $totalCount;
        }

        // Assign the calculated counts to the component property
        $this->assistanceCounterDataTable7 = $counterTotals;
    }

    public $data = [];

    public function CalculateSubcategoryTable8()
    {
        // Define client categories and their respective subcategories
        $categories = [
            'FAMILY HEADS AND OTHER NEEDY ADULT' => [
                'Victims of Disaster',
                'Internally Displaced Family',
                'Solo Parent',
                'Victims of Illegal Recruitment',
                'Surrendered drug users',
                'Repatriated OFW',
                'Killed in Action',
                'Wounded in Action',
                'NONE OF THE ABOVE',
                'Indigenous People',
                'Individuals with Cancer',
                'Person of Concerns - Asylum Seeker',
                'Former Rebels',
                'Dialysis Patients',
                'Tuberculosis Patients',
                'Person of Concerns - Refugees',
                'Person of Concerns - Stateless Persons',
            ],
            'MEN/WOMEN IN SPECIALLY DIFFICULT CIRCUMSTANCES' => [
                'Sexually-abused',
                'Physically-abused/maltreated/battered',
                'Victims of Illegal Recruitment',
                'Victims of involuntary prostitution',
                'Victims of armed conflict',
                'Victims of trafficking',
                'Others specify',
                'Surrendered drug users',
                'Repatriated OFW',
                'Killed in Action',
                'Wounded in Action',
                'NONE OF THE ABOVE',
                'Indigenous People',
                'Individuals with Cancer',
                'Person of Concerns - Asylum Seeker',
                'Former Rebels',
                'Dialysis Patients',
                'Tuberculosis Patients',
                'Person of Concerns - Refugees',
                'Person of Concerns - Stateless Persons',
            ],
            'SENIOR CITIZENS & SENIOR CITIZENS (NO SUBCATEGORIES)' => [
                'NONE OF THE ABOVE',
                'Indigenous People',
                'Individuals with Cancer',
                'Person of Concerns - Asylum Seeker',
                'Former Rebels',
                'Dialysis Patients',
                'Tuberculosis Patients',
                'Person of Concerns - Refugees',
                'Person of Concerns - Stateless Persons',
            ],
            'PERSONS WITH DISABILITIES' => [
                'Orthopedically handicapped',
                'Hearing/Speech impaired',
                'Visually impaired',
                'Mentally challenged',
                'Others specify',
                'Victims of Illegal Recruitment',
                'Surrendered drug users',
                'Repatriated OFW',
                'Killed in Action',
                'Wounded in Action',
                'NONE OF THE ABOVE',
            ],
            'PERSONS LIVING WITH HIV-AIDS' => [
                'Individuals with Cancer',
                'Indigenous People',
                'Tuberculosis Patients',
                'Person of Concerns - Asylum Seeker',
                'Former Rebels',
                'Dialysis Patients',
                'Person of Concerns - Refugees',
                'Person of Concerns - Stateless Persons',
                'NONE OF THE ABOVE',
            ],
        ];

        $result = [];
        foreach ($categories as $category => $subcategories) {
            $clients = Client::whereRaw('LOWER(client_category) = ?', [strtolower($category)])->get();

            $groupedSubcategories = collect($subcategories)->mapWithKeys(function ($subcategory) use ($clients) {
                $filteredClients = $clients->filter(function ($client) use ($subcategory) {
                    return strtolower($client->subcategory) === strtolower($subcategory);
                });

                $maleCount = $filteredClients->where('gender', 'MALE')->count();
                $femaleCount = $filteredClients->where('gender', 'FEMALE')->count();
                $totalAmount = $filteredClients->sum('amount1');

                return [$subcategory => [
                    'name' => $subcategory,
                    'male_count' => $maleCount,
                    'female_count' => $femaleCount,
                    'total_count' => $maleCount + $femaleCount,
                    'total_amount' => $totalAmount,
                ]];
            });

            $result[$category] = ['subcategories' => $groupedSubcategories];
        }

        $this->data = $result;
    }

public function render()
{
    $clients = Client::all();

  //  dd($clients); // This will dump the paginated clients data

    return view('livewire.user.reporting',['clients' => $clients], ['data'=>$this->data]) ->layout('layouts.user-app');
}

}
