<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\rapporta;
use App\Imports\SampleDataImport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;


class ImportController extends Controller
{
    public function importExcel(Request $request)
    {
        Excel::import(new SampleDataImport,request()->file('excelFile'));
        return redirect()->route('rapporta');
    }
}
