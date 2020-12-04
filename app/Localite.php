<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Localite extends Model
{
     protected $fillable = [
   			'libelleL','departement_id'
   	];

      /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   	 public function departement()
    {
    	return $this->belongsTo(Departement::class);
    }

    /**
     * Has Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
     public function souscripteurs()
    {
    	return $this->hasMany(App\Souscripteur::class);
    }
}
