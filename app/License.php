<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    public function softwares()
    {
    	return $this->hasMany('App\Software');
    }
}
