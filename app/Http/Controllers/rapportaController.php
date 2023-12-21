<?php

namespace App\Http\Controllers;
use App\Models\rapporta;
use App\Models\etat;
use App\Models\notification;
use App\Models\User;
use App\Models\correcteur;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class rapportacontroller extends Controller
{
    public function index()
    {
        $totalEnAttente = Etat::where('statut', 'en attente')->count('id_rapporta');
        $totalAccepte = Etat::where('statut', 'accepter')->count('id_rapporta');
        $totalRejete = Etat::where('statut', 'rejeter')->count('id_rapporta');
        $rapportaCount = rapporta::count();
        $rapportas = rapporta::all();
        $data = [
            'rapportaCount' => $rapportaCount,
            'rapportas' => $rapportas,
            'totalEnAttente' => $totalEnAttente,
            'totalRejete' => $totalRejete,
            'totalAccepte' => $totalAccepte,
        ];
        return view('rapporta')->with($data);
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'client' => 'required|string',
            'projet' => 'required|string',
            'constat' => 'required|string',
            'recommandations' => 'required|string',
            'departement' => 'required|string',
            'risque' => ['required', 'in:Acceptable,Moyen,Eleve,--'],
            'priorite' => ['required', 'in:Faible,Moyenne,Elevee,--'],
        ]);
        $user = Auth::user();
        $rapporta = $user->rapporta()->create([
            'client' => $request->client,
            'projet' => $request->projet,
            'constat' => $request->constat,
            'recommandations' => $request->recommandations,
            'departement' => $request->departement,
            'risque' => $request->risque,
            'priorite' => $request->priorite,
        ]);
        $etat = etat::create([
            'id_rapporta' => $rapporta->id,
            'statut' => 'En attente',
        ]);
        Notification::create([
            'id_etat' => $etat->id,
            'action' => 'Action',
            'constat' => $request->constat,
            'recommandations' => $request->recommandations,
        ]);
        $correcteur = correcteur::create([
            'id_etat' => $etat->id,
            'commentaire_management' => $request->commentaire_management,
            'avancement' => $request->avancement,
            'piece_jointe' => $request->piece_jointe,
        ]);
        
        return redirect()->route('rapporta');
    }
    public function update(Request $request, $id)
{
    $rapporta = rapporta::find($id);
    if (!$rapporta) {
        return redirect()->route('rapporta');
    }

    $validatedData = $request->validate([
        'client' => 'required|string',
        'projet' => 'required|string',
        'constat' => 'required|string',
        'recommandations' => 'required|string',
        'departement' => 'required|string',
        'risque' => ['required', 'in:Acceptable,Moyen,Eleve,--'],
        'priorite' => ['required', 'in:Faible,Moyenne,Elevee,--'],
    ]);

    $existingEtat = etat::where('id_rapporta', $rapporta->id)->first();

    if ($rapporta->departement !== $validatedData['departement']) {
        $etat = $existingEtat ?: etat::create([
            'id_rapporta' => $rapporta->id,
            'statut' => 'En attente',
            'commentaire' => '',
        ]);
    } else {
        $etat = $existingEtat;
    }
    $rapporta->update([
        'client' => $validatedData['client'],
        'projet' => $validatedData['projet'],
        'constat' => $validatedData['constat'],
        'recommandations' => $validatedData['recommandations'],
        'departement' => $validatedData['departement'],
        'risque' => $validatedData['risque'],
        'priorite' => $validatedData['priorite'],
    ]);
    if ($etat) { 
        $etat->update([
            'statut' => 'En attente',
        ]);
        $notification = Notification::where('id_etat', $etat->id)->first();
        if ($notification) {
            $notification->update([
                'action' => 'Action',
                'client' => $request->client,
                'projet' => $request->projet,
                'constat' => $request->constat,
                'recommandations' => $request->recommandations,
                'departement' => $request->departement,
                'risque' => $request->risque,
                'priorite' => $request->priorite,
            ]);
        } else {
            Notification::create([
                'id_etat' => $etat->id,
                'action' => 'Action',
                'client' => $request->client,
                'projet' => $request->projet,
                'constat' => $request->constat,
                'recommandations' => $request->recommandations,
                'departement' => $request->departement,
                'risque' => $request->risque,
                'priorite' => $request->priorite,
            ]);
        }

        $correcteur = correcteur::where('id_etat', $etat->id)->first();
        if ($correcteur) {
            $correcteur->update([
                'commentaire_management' => $request->commentaire_management,
                'avancement' => $request->avancement,
                'piece_jointe' => $request->piece_jointe,
            ]);
        } else {
            correcteur::create([
                'id_etat' => $etat->id,
                'commentaire_management' => $request->commentaire_management,
                'avancement' => $request->avancement,
                'piece_jointe' => $request->piece_jointe,
            ]);
        }
        }

        return redirect()->route('rapporta');
    }

    public function destroy($id)
    {
        $rapporta = rapporta::find($id);
        if (!$rapporta) {
            return redirect()->route('rapporta');
        }
        $etat = Etat::where('id_rapporta', $rapporta->id)->first();
        if ($etat) {
            $etat->delete();
        } 
        $notification = notification::where('id_etat', $etat->id)->first();
        if ($notification) {
            $notification->delete();
        } 
        $correcteur = correcteur::where('id_etat', $etat->id)->first();
        if ($correcteur) {
            $correcteur->delete();
        } 
        $rapporta->delete();
        return redirect()->route('rapporta');
    }
    public function cloturer(Request $request, $id)
    {
    $rapportas = rapporta::find($id);
    $etat = etat::where('id', $rapportas->id_etat)->first();
    $rapportas->etat->statut = 'cloturer';
    $rapportas->etat->save();
    return redirect()->route('rapporta');
    }

}
