<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\rapporta;
use App\Models\etat;
use App\Models\Notification;
use App\Models\correcteur;
use Illuminate\Support\Facades\Auth;

class SampleDataImport implements ToModel
{
    private $firstRowSkipped = false;
    public function model(array $row)
    {
        if (!$this->firstRowSkipped) {
            $this->firstRowSkipped = true;
            return null;
        }
        $userId = Auth::id();
        $rapporta = rapporta::create([
            'id_user' => $userId,
            'constat' => $row['0'],
            'recommandations' => $row['1'],
        ]);
        $etat = etat::create([
            'id_rapporta' => $rapporta->id,
            'statut' => 'En attente',
        ]);
        Notification::create([
            'id_etat' => $etat->id,
            'action' => 'Action',
            'constat' => $rapporta->constat,
            'recommandations' => $rapporta->recommandations,
        ]);
        $correcteur = correcteur::create([
            'id_etat' => $etat->id,
            'commentaire_management' => null,
            'avancement' => null,
        ]);

        return $rapporta; 
    }
}