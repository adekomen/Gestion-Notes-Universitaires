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

    public static function boot()
    {
        parent::boot();

        static::saving(function ($model) {
            // Vérification des crédits ECTS
            if ($model->credits_ects < 1 || $model->credits_ects > 30) {
                throw new \Exception("Les crédits ECTS doivent être compris entre 1 et 30.");
            }

            // Vérification du code (format UExx)
            if (!preg_match('/^UE\d{2}$/', $model->code)) {
                return false;
            }

            // Vérification du semestre (1 ou 2 uniquement)
            if (!in_array($model->semestre, [1, 6])) {
                return false;
            }
        });
    }

}
