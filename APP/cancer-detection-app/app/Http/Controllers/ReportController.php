<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ReportController extends Controller
{
    public function generateReport(Request $request)
    {
        // Sample data (replace with dynamic data from your analysis)
        $classification = $request->input('classification', 'Colon benign tissue');
        $confidence = $request->input('confidence', '100.0%');
        $imagePath = $request->input('image_path', public_path('images/sample.jpg')); // Adjust path

        $data = [
            'classification' => $classification,
            'confidence' => $confidence,
            'image_path' => $imagePath,
            'date' => now()->toDateTimeString(),
        ];

        // Load the view and pass the data
        $pdf = PDF::loadView('cancer_detection', $data);

        // Download the PDF
        return $pdf->download('cancer_detection_report.pdf');
    }
}
