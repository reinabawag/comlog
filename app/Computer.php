<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Computer extends Model
{
    public function softwares()
    {
    	return $this->hasMany('App\Software');
    }

    public function hardwares()
    {
    	return $this->hasMany('App\Hardware');
    }

    public function department()
    {
    	return $this->belongsTo('App\Department');
    }
}
