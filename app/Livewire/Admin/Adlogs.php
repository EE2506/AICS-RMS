<?php
namespace App\Livewire\Admin;

use App\Models\UserActivityLog;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Storage;

class Adlogs extends Component
{
    use WithPagination;

    public $search = '';
    public $startDate = '';
    public $endDate = '';

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function exportLogs()
{
    $query = UserActivityLog::where('user_id', Auth::id());

    if ($this->search) {
        $query->where(function ($subQuery) {
            $subQuery->where('activity_type', 'like', '%' . $this->search . '%')
                ->orWhere('description', 'like', '%' . $this->search . '%');
        });
    }

    if ($this->startDate && $this->endDate) {
        $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
    }

    $filteredLogs = $query->orderBy('created_at', 'desc')->get();

    // Create a new Spreadsheet
    $spreadsheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();
    $sheet->setTitle('Activity Logs');

    // Set Header
    $headers = ['User Email', 'Activity Type', 'Description', 'Date'];
    $sheet->fromArray($headers, null, 'A1');

    // Add Logs Data
    $data = $filteredLogs->map(function ($log) {
        return [
            $log->user->email,
            ucfirst($log->activity_type),
            $log->description,
            $log->created_at->format('Y-m-d H:i:s'),
        ];
    })->toArray();

    $sheet->fromArray($data, null, 'A2');

    // Apply Styles to Header
    $headerStyle = [
        'font' => [
            'bold' => true,
            'color' => ['rgb' => 'FFFFFF'],
        ],
        'fill' => [
            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
            'startColor' => ['rgb' => '0654A8'],
        ],
        'alignment' => [
            'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        ],
    ];
    $sheet->getStyle('A1:D1')->applyFromArray($headerStyle);

    // Set Column Widths for Better Visibility
    foreach (range('A', 'D') as $columnID) {
        $sheet->getColumnDimension($columnID)->setAutoSize(true);
    }

    // Apply Borders to the Entire Table
    $highestRow = $sheet->getHighestRow(); // Get the last row with data
    $highestColumn = $sheet->getHighestColumn(); // Get the last column with data

    $tableRange = "A1:{$highestColumn}{$highestRow}"; // Define the range of the table
    $borderStyle = [
        'borders' => [
            'allBorders' => [
                'borderStyle' => \PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN,
                'color' => ['rgb' => '000000'], // Black border color
            ],
        ],
    ];
    $sheet->getStyle($tableRange)->applyFromArray($borderStyle);

    // Save the file to a temporary location
    $fileName = 'activity_logs_' . now()->format('Y-m-d_H-i-s') . '.xlsx';
    $tempFile = storage_path("app/public/{$fileName}");

    $writer = new \PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $writer->save($tempFile);

    // Return file as a download
    return response()->download($tempFile)->deleteFileAfterSend(true);
}


    public function render()
    {
        $query = UserActivityLog::where('user_id', Auth::id());

        if ($this->search) {
            $query->where(function ($subQuery) {
                $subQuery->where('activity_type', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        if ($this->startDate && $this->endDate) {
            $query->whereBetween('created_at', [$this->startDate, $this->endDate]);
        }

        $logs = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.admin.logs', [
            'logs' => $logs,
        ])->layout('layouts.admin-app');
    }
}
