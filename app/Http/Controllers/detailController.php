<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class detailController extends Controller
{

public function show($client)
{
    $recommandations = DB::table('rapporta')
        ->join('etat', 'rapporta.id', '=', 'etat.id_rapporta')
        ->select('rapporta.*', 'etat.statut')
        ->where('rapporta.client', $client)
        ->get();
    return view('detail', compact('recommandations', 'client'));
}

}
