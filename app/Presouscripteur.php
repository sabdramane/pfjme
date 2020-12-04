<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presouscripteur extends Model
{
    protected $fillable = [
   			'nom','prenom','genre','lieuNaissance','dateNaissance',
   			'numCnib','dateEtabCnib','telephone','email','niveauEtude','connaissance','profession',
   			'electricite','electronique','electrotechnique','climatisation','energie','etat','localite_id','dateInscription'
   	];

   	 public function localite()
    {
    	return $this->belongsTo(Localite::class);
    }

    /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
     public function user()
    {
        return $this->belongsTo('App\User');
    }
}
