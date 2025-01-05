<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unites_enseignement extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'nom', 'credits_ects', 'semestre'];

    /**
     * Relation avec les éléments constitutifs (EC).
     * Une UE peut avoir plusieurs EC.
     */
    public function elementsConstitutifs()
    {
        return $this->hasMany(Elements_Constitutif::class, 'ue_id');
    }

}
