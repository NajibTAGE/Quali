<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\rapportas;
use App\Models\rapporta;
use App\Models\etat;
use App\Models\correcteur;
use App\Models\historique;
use ZipArchive;

class correcteurController extends Controller
{
    public function index()
    {
        $usersociete = Auth::user()->societe;
        $totalCloturer = rapporta::whereHas('etat.correcteur', function ($query) use ($usersociete) {
            $query->where('statut', 'cloturer')->where('client', $usersociete);
        })->count();
        $totalEnCours = rapporta::whereHas('etat.correcteur', function ($query) use ($usersociete) {
            $query->where('statut', 'En cours')->where('client', $usersociete);
        })->count();
        $totalEnattente = rapporta::whereHas('etat.correcteur', function ($query) use ($usersociete) {
            $query->where('statut', 'En attente')->where('client', $usersociete);
        })->count();
        $totalrecos = rapporta::whereHas('etat.correcteur', function ($query) use ($usersociete) {
            $query->where('client', $usersociete);
        })->count();
        $rapportas = rapporta::whereHas('etat', function ($query) use ($usersociete) {
            $query->whereIn('statut', ['En cours', 'cloturer','En attente','rejeter','traiter'])->where('client', $usersociete);
        })->get()->sortBy('etat.statut');        
        
        $data = [
            'rapportas' => $rapportas,
            'totalEnCours' => $totalEnCours,
            'totalCloturer' => $totalCloturer,
            'totalEnattente' => $totalEnattente,
            'totalrecos' => $totalrecos,
        ];
        return view('correcteur')->with($data);
    }
    public function update(Request $request, $id)
{   
    $correcteur = correcteur::find($id);
    $etat = etat::where('id', $correcteur->id_etat)->first();
    $validatedData = $request->validate([
        'commentaire_management' => 'required|string',
        'avancement' => ['required', 'in:0%,10%,20%,30%,40%,50%,60%,70%,80%,90%,100%'],
    ]);

    $correcteur->update([ 
        'commentaire_management' => $validatedData['commentaire_management'],
        'avancement' => $validatedData['avancement'],
    ]);
    
    
    return redirect()->route('correcteur');
   }

   public function telechargerFichier($id)
   {
    $correcteur = correcteur::findOrFail($id);
        $cheminFichier = $correcteur->chemin_fichier;

        return response()->download(storage_path('app/public/' . $cheminFichier));
   }
   
   public function ajouterFichier(Request $request, $id)
   {
    $correcteur = correcteur::findOrFail($id);

    if ($correcteur->chemin_fichier) {
        Storage::disk('public')->delete($correcteur->chemin_fichier);
    }
        if ($request->hasFile('piece_jointe')) {
        $fichier = $request->file('piece_jointe');
        $nomOriginal = $fichier->getClientOriginalName();  
        $chemin = $fichier->storeAs('uploaded_files', $nomOriginal, 'public');  
        $correcteur->chemin_fichier = $chemin;
        $correcteur->livrable = $fichier->getClientOriginalName();
        $correcteur->save();
        return redirect()->route('correcteur');
    }
}
public function Cloturer(Request $request, $id)
{
    $rapportas = correcteur::findOrFail($id);
    $etat = etat::where('id', $rapportas->id_etat)->first();
    $rapportas->etat->statut = 'cloturer';
    $rapportas->etat->commentaire = $request->input('commentaire');
    $rapportas->etat->save();
    return redirect()->route('correcteur');
}
public function traiter(Request $request, $id)
{
    $rapportas = correcteur::find($id);
    $etat = etat::where('id', $rapportas->id_etat)->first();
    $rapportas->etat->statut = 'traiter';
    $rapportas->etat->save();
    return redirect()->route('correcteur');
}

public function accept($id)
{
    $rapportas = rapporta::findOrFail($id);
    $etat = etat::where('id', $rapportas->id_etat)->first();
    $rapportas->etat->statut = 'En cours';
    $rapportas->etat->save();
    return redirect()->route('correcteur');
}

public function rejeter(Request $request, $id)
{
    $rapportas = correcteur::find($id);
    $etat = etat::where('id', $rapportas->id_etat)->first();
    $rapportas->etat->statut = 'rejeter';
    $rapportas->etat->save();
    return redirect()->route('correcteur');
}


}
