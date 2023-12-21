<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rapporta extends Model
{
    protected $table = 'rapporta'; 
    protected $guarded = ['id_user'];
    protected $fillable = ['id_user','client', 'projet', 'constat', 'recommandations', 'departement', 'risque', 'priorite'];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function etat()
    {
        return $this->hasOne(etat::class, 'id_rapporta');
    }
}
