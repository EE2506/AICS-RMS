<?php
namespace App\Imports;

use App\Models\Client;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date as ExcelDate;

class ClientsImport implements ToModel, WithHeadingRow
{
    protected function normalizeHeaders(array $row)
    {
        $normalized = [];
        foreach ($row as $header => $value) {
            // Allow letters, numbers, and replace spaces/special characters with underscores
            $normalizedHeader = strtolower(preg_replace('/[^a-z0-9]/i', '_', $header));
            // Remove multiple underscores
            $normalizedHeader = preg_replace('/_+/', '_', $normalizedHeader);
            // Remove trailing underscores
            $normalizedHeader = rtrim($normalizedHeader, '_');
            $normalized[$normalizedHeader] = $value;
        }

        return $normalized;
    }

    public function model(array $row)
    {
        $normalizedRow = $this->normalizeHeaders($row);

        // Debug command
       // dd($normalizedRow);

        if ($this->isRowEmpty($normalizedRow)) {
            return null;
        }

        return new Client([
            'field_office' => $normalizedRow['field_office'] ?? null,
            'entered_by' => $normalizedRow['entered_by'] ?? null,
            'client_no' => $normalizedRow['client_no'] ?? null,
            'date_accomplished' => $this->transformDate($normalizedRow['date_accomplished']),
            'region' => $normalizedRow['region'] ?? null,
            'province' => $normalizedRow['province'] ?? null,
            'city_municipality' => $normalizedRow['citymunicipality'] ?? null, // Use normalized key
            'barangay' => $normalizedRow['barangay'] ?? null,
            'district' => $normalizedRow['district'] ?? null,
            'last_name' => $normalizedRow['lastname'] ?? null,
            'first_name' => $normalizedRow['firstname'] ?? null,
            'middle_name' => $normalizedRow['middlename'] ?? null,
            'extra_name' => $normalizedRow['extraname'] ?? null,
            'sex' => $normalizedRow['sex'] ?? null,
            'civil_status' => $normalizedRow['civilstatus'] ?? null,
            'dob' => $this->transformDOB($normalizedRow['dob']),
            'age' => $normalizedRow['age'] ?? null,
            'mode_of_admission' => $normalizedRow['modeofadmission'] ?? null,
            'type_of_assistance1' => $normalizedRow['type_of_assistance1'] ?? null,
            'amount1' => $this->transformAmount($normalizedRow['amount1'] ?? null),
            'source_of_fund1' => $normalizedRow['source_of_fund1'] ?? null,
            'type_of_assistance2' => $normalizedRow['type_of_assistance2'] ?? null,
            'amount2' => $this->transformAmount($normalizedRow['amount2'] ?? null),
            'source_of_fund2' => $normalizedRow['source_of_fund2'] ?? null,
            'type_of_assistance3' => $normalizedRow['type_of_assistance3'] ?? null,
            'amount3' => $this->transformAmount($normalizedRow['amount3'] ?? null),
            'source_of_fund3' => $normalizedRow['source_of_fund3'] ?? null,
            'type_of_assistance4' => $normalizedRow['type_of_assistance4'] ?? null,
            'amount4' => $this->transformAmount($normalizedRow['amount4'] ?? null),
            'source_of_fund4' => $normalizedRow['source_of_fund4'] ?? null,
            'client_category' => $normalizedRow['clientcategory'] ?? null,
            'subcategory' => $normalizedRow['subcategory'] ?? null,
            'through' => $normalizedRow['through'] ?? null,
        ]);
    }

    protected function isRowEmpty(array $row)
    {
        return collect($row)->filter()->isEmpty();
    }

    protected function transformDate($value)
    {
        if (is_numeric($value)) {
            return ExcelDate::excelToDateTimeObject($value)->format('Y-m-d');
        }
        return \DateTime::createFromFormat('d/m/Y', $value) ? \DateTime::createFromFormat('d/m/Y', $value)->format('Y-m-d') : null;
    }

    protected function transformDOB($value)
    {
        if (is_numeric($value)) {
            // Convert Excel serial date to DateTime object and format it as Y-m-d
            return ExcelDate::excelToDateTimeObject($value)->format('Y-m-d');
        }

        // Attempt to parse the date in the expected format d/m/Y
        $date = \DateTime::createFromFormat('d/m/Y', $value);

        // If the date was successfully parsed, return it formatted as Y-m-d; otherwise, return null
        return $date ? $date->format('Y-m-d') : null;
    }


    protected function transformAmount($value)
    {
        if (is_numeric($value)) {
            // If it's an Excel numeric value, return it as a float
            return (float) $value;
        }

        if (is_string($value)) {
            // Remove commas from the amount string
            $value = str_replace(',', '', $value);

            // Convert the cleaned value to a float if numeric
            return is_numeric($value) ? (float) $value : null;
        }

        // If the value isn't numeric or a string that can be processed, return null
        return null;
    }
}
