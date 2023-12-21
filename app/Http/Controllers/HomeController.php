<?php

namespace App\Http\Controllers;
use App\Models\rapporta;
use App\Models\etat;
use App\Models\notification;
use App\Models\User;
use App\Models\correcteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


class HomeController extends Controller
{
    public function index()
    {
        $totalEnAttente = Etat::where('statut', 'en attente')->count('id_rapporta');
        $totalAccepte = Etat::where('statut', 'En cours')->count('id_rapporta');
        $totalcloturer = Etat::where('statut', 'cloturer')->count('id_rapporta');
        $totaltraiter = Etat::where('statut', 'traiter')->count('id_rapporta');
        $totalRejete = Etat::where('statut', 'rejeter')->count('id_rapporta');
        $rapportaCount = rapporta::count();

        $data = DB::table('rapporta')
            ->join('etat', 'rapporta.id', '=', 'etat.id_rapporta')
            ->select('rapporta.client')
            ->selectRaw('COUNT(rapporta.id) as total_recommandations')
            ->selectRaw('SUM(CASE WHEN etat.statut = "En Attente" THEN 1 ELSE 0 END) as recommandations_attente')
            ->selectRaw('SUM(CASE WHEN etat.statut = "En cours" THEN 1 ELSE 0 END) as recommandations_en_cours')
            ->selectRaw('SUM(CASE WHEN etat.statut = "traiter" THEN 1 ELSE 0 END) as recommandations_traiter')
            ->selectRaw('SUM(CASE WHEN etat.statut = "Cloturer" THEN 1 ELSE 0 END) as recommandations_cloture')
            ->selectRaw('SUM(CASE WHEN etat.statut = "rejeter" THEN 1 ELSE 0 END) as recommandations_rejeter')
            ->groupBy('rapporta.client')
            ->get();
        
        return view('home', compact('data','rapportaCount', 'totalEnAttente', 'totalAccepte', 'totalRejete','totaltraiter','totalcloturer'));
        

    }
    
    public function calculerTotalRecos($idClient, $colonne)
{
    return DB::table('rapporta')
        ->join('etat', 'rapporta.id_etat', '=', 'etat.id')
        ->join('tdb', 'etat.id', '=', 'tdb.id_etat')
        ->where('rapporta.id_client', $idClient)
        ->sum('tdb.' . $colonne);
}
}
