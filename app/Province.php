<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $fillable = [
   			'libelleP','region_id'
   	];

      /**
     * One to Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
   	 public function region()
    {
    	return $this->belongsTo('App\Region');
    }

    /**
     * Has Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function departements()
    {
    	return $this->hasMany(App\Departement::class);
    }
}
