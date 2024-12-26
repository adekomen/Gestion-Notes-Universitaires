<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Elements_constitutif extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'nom', 'coefficient', 'ue_id'];

    /**
     * Relation avec une UE (Unité d'Enseignement).
     * Un EC appartient à une seule UE.
     */
    public function uniteEnseignement()
    {
        return $this->belongsTo(Unites_enseignement::class, 'ue_id');
    }

    /**
     * Relation avec les notes.
     * Un EC peut avoir plusieurs notes associées.
     */
    public function notes()
    {
        return $this->hasMany(Note::class, 'ec_id');
    }
}
