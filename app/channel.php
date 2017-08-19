<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class channel extends Model
{
    //
	protected $fillable =[
		'name',
		'slug'
	];

    public function posts(){
    	return $this->hasMany(post::class);
    }
}
