<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Moyenne extends Model
{
    use HasFactory;

    protected $fillable = [
        'etudiant_id',
        'ue_id',
        'moyenne',
    ];

    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class);
    }

    public function ue()
    {
        return $this->belongsTo(UniteEnseignement::class);
    }
}
