<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Etudiant extends Model
{
    use HasFactory;

    protected $fillable = ['numero_etudiant', 'nom', 'prenom', 'niveau'];

    /**
     * Relation avec les notes.
     * Un étudiant peut avoir plusieurs notes.
     */
    public function notes()
    {
        return $this->hasMany(Note::class, 'etudiant_id');
    }
}
