<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hardware extends Model
{
	use SoftDeletes;

	protected $dates = ['deleted_at'];

    public function computer()
    {
    	return $this->belongsTo('App\Computer');
    }
}
