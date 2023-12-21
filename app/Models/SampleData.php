<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromQuery;

class SampleData extends Model
{
    protected $table = 'rapporta';
    public function etat()
    {
        return $this->hasOne(Etat::class, 'id');
    }

    public function planification()
    {
        return $this->hasOne(Planification::class, 'id');
    }
    public static function customQuery()
    {
        return self::query()
            ->with('etat.planification') 
            ->where('colonne', 'valeur')
            ->orderBy('colonne')
            ->get();
    }
    
}
