<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'titre', 'abrege',
    ];

    /**
     * Has Many relation
     *
     * @return Illuminate\Database\Eloquent\Relations\hasMany
     */
    public function users()
    {
    	return $this->hasMany('App\User');
    }
}
