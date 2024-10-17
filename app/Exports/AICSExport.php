<?php
namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class AICSExport implements FromArray, WithHeadings, ShouldAutoSize
{
    protected $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function array(): array
    {
        $exportData = [];

        // Add summary data
        $exportData[] = ['Total Served Clients', $this->data['totalServedClients']];
        $exportData[] = ['Total Amount Assistance', $this->data['totalAmountAssistance']];
        $exportData[] = ['Most Requested Assistance', $this->data['mostRequestedAssistance']];
        $exportData[] = ['Total Documents', $this->data['totalDocument']];
        $exportData[] = ['Total Recycles', $this->data['totalRecycles']];

        // Add a blank row for separation
        $exportData[] = [];

        // Add client category data
        $exportData[] = ['Client Category', 'Total Amount'];
        foreach ($this->data['clientCategoryData'] as $category => $amount) {
            $exportData[] = [$category, $amount];
        }

        // Add a blank row for separation
        $exportData[] = [];

        // Add age bracket data
        $exportData[] = ['Age Bracket', 'Count'];
        foreach ($this->data['ageBracketData'] as $ageBracket => $count) {
            $exportData[] = [$ageBracket, $count];
        }

        // Add more sections for other data as needed

        return $exportData;
    }

    public function headings(): array
    {
        return [
            'Dashboard Analytics Export',
            'Generated on ' . now()->toDateTimeString(),
        ];
    }
}
