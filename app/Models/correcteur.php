<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class correcteur extends Model
{
    protected $table = 'correcteur';

    protected $fillable = ['id_etat', 'commentaire_management', 'piece_jointe', 'avancement'];

    public function etat()
    {
        return $this->belongsTo(etat::class, 'id_etat');
    }
}

