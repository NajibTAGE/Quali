<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\SampleDataExport;
use Maatwebsite\Excel\Facades\Excel;
use App\Models\rapporta;

class ExportController extends Controller
{
    public function exportToExcel(Request $request)
    {
        $selectedRowsExcel = explode(',', $request->input('selectedRows'));
        $columns = $request->input('columns');
        $exporter = new SampleDataExport($columns,$selectedRowsExcel);
        return Excel::download($exporter, 'Rapport D\'audit.xlsx');
    }
}
