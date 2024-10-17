<?php
namespace App\Livewire\User;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AICSExport;
use App\Models\Document;
use App\Models\Recycle;
use App\Models\Client;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use App\Models\DashboardReportExports;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Dashboard extends Component

{
    public $selectedDate;

    public $totalDocument, $totalRecycles, $totalMedical, $totalFuneral, $totalFoodAssistance;
    public $totalServedClients,$totalAmountAssistance, $mostRequestedAssistance, $dobData;

    public $genderDistribution, $ageDistribution;
    public $data = ['client'];

    public $table2TotalAmountAssistance, $table2MostRequestedAssistance, $table3TotalAmountAssistance,$table2TotalClients, $table3ClientMostAsistanceRelease, $table3TotalClients , $table3ClientCategoryWithMostAssistanceReleased,$table4TotalClients, $table6TotalClients;
    public $table4TotalAmountAssistance, $table4ageGroupWithMostAssistanceReleased,  $table4MostRequestedAssistance;
    public $ageGroups, $ageGroupCounts = [];
    // Properties for Table 4
    public $assistanceData = [];
    // Properties for Table 5
    public $table5ModeOfAdmissionData,  $table5GenderDistributionData, $table5MostUsedAdmissionMode ;
    public $genderCountReferral = [];
    public $genderCountWalkIn = [];
    public $amountReferral = [];
    public $amountWalkIn = [];
    public $clientCategoryData = [];
    public $ageBracketData = [];
    public $ClienAssistanceData = [];
    public $clientAssistanceData;
    public $typeofAssistanceData = [];
    public $typeofAssistance;
    public $typeofServiceAssistance = ['MEDICAL', 'FUNERAL', 'FOOD', 'EDUCATIONAL', 'FINANCIAL', 'HYGIENE & SLEEPING KITS', 'OTHERS'];
    public  $servedData = [];
    public $servedAssistanceData;
    public $districts = [
        'Davao City 1st',
        'Davao City 2nd',
        'Davao City 3rd',
        'Davao Occidental Lone District',
        'Davao del Norte 1st',
        'Davao del Norte 2nd',
        'ROR',
        'Davao Oriental 1st',
        'Davao Oriental 2nd',
        'Davao del Sur Lone District'
    ];

    public $budgetData = [];

    // Properties for Table 6
public $table6MostUsedAdmissionMode, $table6ModeOfAdmissionData,  $table6GenderDistributionData, $table6TotalAmountAssistance, $table6GenderBarChartData;
public $clientCategories,  $categoryCounts = [];

public $genderCountOnsite, $amountOnsite, $genderCountOffsite, $amountOffsite,  $genderCountMalasakit, $amountMalasakit;




    public function mount()
    {
        $this->totalServedClients = Client::count('id');
        $this->totalAmountAssistance = '₱' . number_format(Client::sum('amount1'), 2);
        $this->mostRequestedAssistance = Client::select('type_of_assistance1', DB::raw('COUNT(type_of_assistance1) as count'))
            ->groupBy('type_of_assistance1')
            ->orderByDesc('count')
            ->first()
            ->type_of_assistance1;

        $this->totalDocument = Document::count();
        $this->totalRecycles = Recycle::count();

        // Table 1 Functions
        // Fetch data for client category (Assistance Type Distribution)
        $this->clientCategoryData = Client::select('client_category', DB::raw('SUM(amount1) as total'))
            ->groupBy('client_category')
            ->pluck('total', 'client_category')
            ->toArray();

        // Fetch data for age bracket (Age Distribution Per Gender)
        $this->ageBracketData = Client::select('age', DB::raw('COUNT(id) as count'))
            ->groupBy('age')
            ->pluck('count', 'age')
            ->toArray();

        // Fetch assistance data for progress bars
        $this->clientAssistanceData = Client::selectRaw('type_of_assistance1, SUM(CASE WHEN sex = "FEMALE" THEN 1 ELSE 0 END) as FEMALE, SUM(CASE WHEN sex = "MALE" THEN 1 ELSE 0 END) as MALE, COUNT(id) as TOTAL')
            ->groupBy('type_of_assistance1')
            ->get()
            ->keyBy('type_of_assistance1')
            ->toArray();

        $this->ageDistribution = Client::selectRaw('age, COUNT(*) as total')
            ->groupBy('age')
            ->pluck('total', 'age');

        $this->genderDistribution = Client::selectRaw('sex, COUNT(*) as total')
            ->groupBy('sex')
            ->pluck('total', 'sex');


        // Fetch age bracket distribution
        $this->ageBracketData = $this->getAgeBracketDistribution();

        // Table 1 Functions
        // Fetch data for client category (Assistance Type Distribution)
        $this->clientCategoryData = Client::select('client_category', DB::raw('SUM(amount1) as total'))
            ->groupBy('client_category')
            ->pluck('total', 'client_category')
            ->toArray();

        // Fetch assistance data for progress bars
        $this->clientAssistanceData = Client::selectRaw('type_of_assistance1, SUM(CASE WHEN sex = "FEMALE" THEN 1 ELSE 0 END) as FEMALE, SUM(CASE WHEN sex = "MALE" THEN 1 ELSE 0 END) as MALE, COUNT(id) as TOTAL')
            ->groupBy('type_of_assistance1')
            ->get()
            ->keyBy('type_of_assistance1')
            ->toArray();




        $this->table2TotalAmountAssistance = Client::sum('amount1');
        $this->table2TotalClients = Client::count('id');

        $this->table3TotalAmountAssistance = Client::sum('amount1');
        $this->table3TotalClients = Client::count('id');
        $this->table3ClientCategoryWithMostAssistanceReleased = $this->getClientCategoryWithMostAssistanceReleased();

        $this->table4TotalAmountAssistance = Client::sum('amount1');
        $this->table4TotalClients = Client::count('id');
        $this->table4ageGroupWithMostAssistanceReleased = $this->getAgeGroupWithMostAssistanceReleased();

        $typeofAssistance = ['MEDICAL', 'FUNERAL', 'FOOD', 'EDUCATIONAL','FINANCIAL', 'HYGIENE & SLEEPING KITS', 'OTHERS' ];
        foreach ($typeofAssistance as $type) {
            $this->assistanceData[$type] = [
                'FEMALE' => Client::select('sex', DB::raw('COUNT(*) as total'), DB::raw('SUM(amount1) as total_amount'))
                    ->where('type_of_assistance1', $type)
                    ->where('sex', 'FEMALE')
                    ->groupBy('sex')
                    ->first(),
                'MALE' => Client::select('sex', DB::raw('COUNT(*) as total'), DB::raw('SUM(amount1) as total_amount'))
                    ->where('type_of_assistance1', $type)
                    ->where('sex', 'MALE')
                    ->groupBy('sex')
                    ->first(),
            ];
            $this->assistanceData[$type]['TOTAL'] = [
                'total' => ($this->assistanceData[$type]['FEMALE']->total ?? 0) + ($this->assistanceData[$type]['MALE']->total ?? 0),
                'total_amount' => ($this->assistanceData[$type]['FEMALE']->total_amount ?? 0) + ($this->assistanceData[$type]['MALE']->total_amount ?? 0),
            ];
        }

        $this->table5ModeOfAdmissionData = Client::select('mode_of_admission', DB::raw('COUNT(*) as count'))
            ->groupBy('mode_of_admission')
            ->pluck('count', 'mode_of_admission');

        $this->table5GenderDistributionData = Client::select('sex', DB::raw('COUNT(*) as count'))
            ->groupBy('sex')
            ->pluck('count', 'sex');

        $this->genderCountReferral = Client::select('sex', DB::raw('COUNT(*) as total'))
            ->where('mode_of_admission', 'Referral')
            ->groupBy('sex')
            ->pluck('total', 'sex')
            ->toArray();

        $this->amountReferral = Client::select('sex', DB::raw('SUM(amount1) as total_amount'))
            ->where('mode_of_admission', 'Referral')
            ->groupBy('sex')
            ->pluck('total_amount', 'sex')
            ->toArray();

        $this->genderCountWalkIn = Client::select('sex', DB::raw('COUNT(*) as total'))
            ->where('mode_of_admission', 'Walk-In')
            ->groupBy('sex')
            ->pluck('total', 'sex')
            ->toArray();

        $this->amountWalkIn = Client::select('sex', DB::raw('SUM(amount1) as total_amount'))
            ->where('mode_of_admission', 'Walk-In')
            ->groupBy('sex')
            ->pluck('total_amount', 'sex')
            ->toArray();

        $this->table5MostUsedAdmissionMode = Client::select('mode_of_admission', DB::raw('COUNT(*) as count'))
            ->groupBy('mode_of_admission')
            ->orderByDesc('count')
            ->first()
            ->mode_of_admission;

        $this->table6TotalAmountAssistance = Client::sum('amount1');
        $this->table6TotalClients = Client::count('id');
        $this->table6MostUsedAdmissionMode = Client::select('through', DB::raw('COUNT(*) as count'))
            ->groupBy('through')
            ->orderByDesc('count')
            ->first()
            ->through;

        $this->table6ModeOfAdmissionData = Client::select('through', DB::raw('COUNT(*) as count'))
            ->groupBy('through')
            ->pluck('count', 'through');

        $this->table6GenderDistributionData = Client::select('sex', DB::raw('COUNT(*) as count'))
            ->groupBy('sex')
            ->pluck('count', 'sex');

        $this->genderCountOnsite = Client::select('sex', DB::raw('COUNT(*) as total'))
            ->where('through', 'onsite')
            ->groupBy('sex')
            ->pluck('total', 'sex')
            ->toArray();

        $this->amountOnsite = Client::select('sex', DB::raw('SUM(amount1) as total_amount'))
            ->where('through', 'onsite')
            ->groupBy('sex')
            ->pluck('total_amount', 'sex')
            ->toArray();

        $this->genderCountOffsite = Client::select('sex', DB::raw('COUNT(*) as total'))
            ->where('through', 'offsite')
            ->groupBy('sex')
            ->pluck('total', 'sex')
            ->toArray();

        $this->amountOffsite = Client::select('sex', DB::raw('SUM(amount1) as total_amount'))
            ->where('through', 'offsite')
            ->groupBy('sex')
            ->pluck('total_amount', 'sex')
            ->toArray();

        $this->genderCountMalasakit = Client::select('sex', DB::raw('COUNT(*) as total'))
            ->where('through', 'malasakit')
            ->groupBy('sex')
            ->pluck('total', 'sex')
            ->toArray();

        $this->amountMalasakit = Client::select('sex', DB::raw('SUM(amount1) as total_amount'))
            ->where('through', 'malasakit')
            ->groupBy('sex')
            ->pluck('total_amount', 'sex')
            ->toArray();

        // Fetch total amount released per type of assistance
        $this->typeofAssistanceData = Client::select('type_of_assistance1', DB::raw('SUM(amount1) as total_amount'))
            ->groupBy('type_of_assistance1')
            ->get()
            ->toArray();

        $this->fetchBudgetData();
        $this->getServedAssistanceData ();

        $this->servedAssistanceData = Client::select('type_of_assistance1', DB::raw('SUM(amount1) as total_amount'))
        ->groupBy('type_of_assistance1')
        ->get()
        ->pluck('total_amount', 'type_of_assistance1'); // Collect the data with assistance type as key

    // Prepare the data for rendering
        $this->servedData = $this->getServedAssistanceData();

    }
    public function fetchBudgetData()
    {
        $this->budgetData = Client::select('district', DB::raw('SUM(amount1) as total_amount'))
            ->whereIn('district', $this->districts)
            ->groupBy('district')
            ->get()
            ->pluck('total_amount', 'district')
            ->toArray();
    }

    public function getServedAssistanceData()
    {
        $typeofServiceAssistance = ['MEDICAL', 'FUNERAL', 'FOOD', 'EDUCATIONAL', 'FINANCIAL', 'HYGIENE & SLEEPING KITS', 'OTHERS'];
        $servedData = [];

        foreach ($typeofServiceAssistance as $type) {
            // Check if the total amount for the assistance type exists
            $servedData[$type] = $this->servedAssistanceData[$type] ?? 0; // Default to 0 if no data found
        }

        return $servedData;
    }

    public function getAgeGroupWithMostAssistanceReleased()
    {
        $ageGroups = [
            '0-13' => [0, 13],
            '14-17' => [14, 17],
            '18-29' => [18, 29],
            '30-44' => [30, 44],
            '45-59' => [45, 59],
            '60-70' => [60, 70],
            '71-79' => [71, 79],
            '80 and above' => [80, PHP_INT_MAX],
        ];

        $ageGroupCounts = [];
        foreach ($ageGroups as $label => [$minAge, $maxAge]) {
            $count = Client::whereBetween('age', [$minAge, $maxAge])->count();
            $ageGroupCounts[$label] = $count;
        }

        $maxGroup = array_keys($ageGroupCounts, max($ageGroupCounts))[0];
        return $maxGroup;
    }

    public function getClientCategoryData()
{
    // Query to fetch data from the database
    $data = Client::table('client_category')
        ->select('category',  Client::raw('SUM(CASE WHEN sex = "Female" THEN 1 ELSE 0 END) as female_count'), Client::raw('SUM(CASE WHEN sex = "Male" THEN 1 ELSE 0 END) as male_count'))
        ->groupBy('category')
        ->get();

    // Return the data as JSON to the frontend
    return response()->json($data);
}

    public function getAgeBracketDistribution()
{
    $ageBrackets = [
        '0-13' => [0, 13],
        '14-17' => [14, 17],
        '18-29' => [18, 29],
        '30-44' => [30, 44],
        '45-59' => [45, 59],
        '60-70' => [60, 70],
        '71-79' => [71, 79],
        '80+' => [80, PHP_INT_MAX],
    ];

    $ageBracketCounts = [];

    foreach ($ageBrackets as $label => [$minAge, $maxAge]) {
        $count = Client::whereBetween('age', [$minAge, $maxAge])->count();
        $ageBracketCounts[$label] = $count;
    }

    return $ageBracketCounts;
}


    public function getClientCategoryWithMostAssistanceReleased()
    {
        $clientCategories = [
            'Family Heads and Other Needy Adult (FHONA)',
            'Men/Women in Specially Difficult Circumstances (WEDC)',
            'Children in Need of Special Protection (CNSP)',
            'Youth (YNSP)',
            'Senior Citizens (SC)',
            'Persons with Disabilities (PWD)',
            'Persons Living with HIV-AIDS (PLHIV)',
        ];

        $categoryCounts = [];
        foreach ($clientCategories as $category) {
            $count = Client::where('client_category', $category)->count();
            $categoryCounts[$category] = $count;
        }

        $maxCategory = array_keys($categoryCounts, max($categoryCounts))[0];
        return $maxCategory;
    }

    use WithFileUploads;

    public $image;

    public function saveImage()
    {
        $this->validate([
            'image' => 'required|image|max:2048', // 2MB Max
        ]);

        $path = $this->image->store('dashboards', 'public');

        $report = DashboardReportExports::create([
            'image_path' => $path,
            // Add other necessary fields
        ]);

        return response()->json(['reportId' => $report->id]);
    }

    public function downloadPdf($reportId)
    {
        $report = DashboardReportExports::findOrFail($reportId);
        $imageFullPath = Storage::disk('public')->path($report->image_path);

        $pdf = Pdf::loadView('pdf.dashboard', ['imagePath' => $imageFullPath]);

        $pdfFileName = 'dashboard-' . $reportId . '-' . time() . '.pdf';
        $pdfPath = 'pdfs/' . $pdfFileName;

        Storage::disk('public')->put($pdfPath, $pdf->output());

        $report->update(['pdf_path' => $pdfPath]);

        return response()->download(Storage::disk('public')->path($pdfPath), $pdfFileName);
    }


        public function render()
        {
            return view('livewire.user.dashboard', [



                'table4ageGroupWithMostAssistanceReleased' => $this->table4ageGroupWithMostAssistanceReleased,
                'ageGroupCounts' => $this->ageGroupCounts,
                'table5ModeOfAdmissionData' => $this->table5ModeOfAdmissionData,
                'table5GenderDistributionData' => $this->table5GenderDistributionData,
                'genderCountReferral' => $this->genderCountReferral,
                'genderCountWalkIn' => $this->genderCountWalkIn,
                'amountReferral' => $this->amountReferral,
                'amountWalkIn' => $this->amountWalkIn,
                'table6TotalAmountAssistance' => $this->table6TotalAmountAssistance,
                'table6TotalClients' => $this->table6TotalClients,
                'table6MostUsedAdmissionMode' => $this->table6MostUsedAdmissionMode,
                'table6ModeOfAdmissionData' => $this->table6ModeOfAdmissionData,
                'table6GenderDistributionData' => $this->table6GenderDistributionData,
                'table6GenderBarChartData' => $this->table6GenderBarChartData,
                'genderCountOnsite' => $this ->genderCountOnsite,
                'amountOnsite' => $this ->amountOnsite,
                'genderCountOffsite' => $this ->genderCountOnsite,
                'amountOffsite' => $this ->amountOnsite,
                'genderCountMalasakit' => $this ->genderCountMalasakit,
                'amountMalasakit' => $this ->amountMalasakit,
                'clientCategoryData' => $this->clientCategoryData,
                'ageBracketData' => $this->ageBracketData,
                'clientAssistanceData' => $this->clientAssistanceData,
                'typeofAssistanceData' => $this->typeofAssistanceData,
                'assistanceData'  => $this-> assistanceData,
                'typeofServiceAssistance'=> $this-> typeofServiceAssistance,
                'servedData ' => $this-> servedData,
                'budgetData' => $this-> budgetData,

            ])
            ->with('data', $this->data)
            ->layout('layouts.user-app');
        }
        }
