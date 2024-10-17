<?php
namespace App\Http\Livewire;

use App\Models\DashboardReportExports;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class DashboardReportExport extends Component
{
    public function saveImage(Request $request)
    {
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $path = $image->store('dashboard-reports', 'public');

            // Save the image path to the database
            $report = DashboardReportExport::create([
                'image_path' => $path,
            ]);

            return response()->json(['reportId' => $report->id]);
        }

        return response()->json(['error' => 'Image upload failed'], 500);
    }

    public function downloadPdf($reportId)
    {
        $report = DashboardReportExport::findOrFail($reportId);
        $imageFullPath = storage_path('app/public/' . $report->image_path);

        $pdf = Pdf::loadView('pdf.dashboard-report', ['image' => $imageFullPath]);

        // Save the PDF path
        $pdfPath = 'pdfs/dashboard-report-' . time() . '.pdf';
        $pdf->save(storage_path('app/public/' . $pdfPath));

        $report->update(['pdf_path' => $pdfPath]);

        return $pdf->download('dashboard-report.pdf');
    }
}
