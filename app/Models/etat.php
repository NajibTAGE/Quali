<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class etat extends Model
{
    protected $table = 'etat'; 
    protected $fillable = ['id_rapporta', 'statut', 'commentaire'];

    public function rapporta()
    {
        return $this->belongsTo(rapporta::class, 'id_rapporta');
    }
    public function notification()
    {
        return $this->hasOne(Notification::class, 'id_etat');
    }
    public function correcteur()
    {
        return $this->hasOne(correcteur::class, 'id_etat');
    }
    public function tdb()
    {
        return $this->belongsTo(tdb::class, 'id_tdb');
    }
}
