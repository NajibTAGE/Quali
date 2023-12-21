<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notification extends Model
{
    protected $table = 'notification';
    protected $fillable = ['id_etat', 'action'];

    public function etat()
    {
        return $this->belongsTo(etat::class, 'id_etat');
    }

    public function correcteur()
    {
        return $this->belongsTo(Correcteur::class, 'id_correcteur');
    }
}
