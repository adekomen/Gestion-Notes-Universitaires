<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    protected $fillable = ['etudiant_id', 'ec_id', 'note', 'session', 'date_evaluation'];

    /**
     * Relation avec un étudiant.
     * Une note appartient à un seul étudiant.
     */
    public function etudiant()
    {
        return $this->belongsTo(Etudiant::class, 'etudiant_id');
    }

    /**
     * Relation avec un EC (Élément Constitutif).
     * Une note est liée à un seul EC.
     */
    public function elementConstitutif()
    {
        return $this->belongsTo(Elements_Constitutif::class, 'ec_id');
    }

    public function ue()
    {
        return $this->belongsTo(Unites_enseignement::class, 'ue_id');
    }
}
