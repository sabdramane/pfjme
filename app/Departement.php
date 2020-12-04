<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Departement extends Model
{
    protected $fillable = [
   			'libelleD','province_id'
   	];


   	  /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   	 public function province()
    {
    	return $this->belongsTo(Province::class);
    }

    /**
     * Has Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function localites()
    {
      return $this->hasMany(App\Localite::class);
    }
}
