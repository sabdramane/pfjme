<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
	protected $fillable = [
   			'libelleR'
   	];
   	
   	/**
     * Has Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function provinces()
    {
    	return $this->hasMany('App\Province');
    }
}
