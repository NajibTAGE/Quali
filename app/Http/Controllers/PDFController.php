<?php

namespace App\Http\Controllers;

use PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use App\Models\rapporta;

class PDFController extends Controller
{
    public function generatePDF(Request $request)
    {
        $selectedRowsPDF = explode(',', $request->input('selectedRows'));
        $rapportas = rapporta::whereIn('id', $selectedRowsPDF)->get();
        $data = [
            'title' => 'Rapport d\'audit',
            'rapportas' => $rapportas,
        ];

        $pdf = PDF::loadView('pdf', $data);
        
        
        $dompdf = new Dompdf();
    
        $view = view('pdf', $data)->render();
    
        $dompdf->loadHtml($view);
    
        $dompdf->setPaper('A4', 'portrait');
    
        $dompdf->render(['compress' => 1]);
    
        $dompdf->stream('rapport_audit.pdf', ['Attachment' => true]);
    
        return $pdf->download('rapport_audit.pdf');
    }
}
