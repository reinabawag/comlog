<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Software extends Model
{
	use SoftDeletes;

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = ['deleted_at'];
    
	public $rules = [
		'computer_id' => 'required|integer',
		'description' => 'required',
		'license_type' => 'required',
		'license_id' => 'integer'
	];

	public function computer()
	{
		return $this->belongsTo('App\Computer');
	}

	public function license()
	{
		return $this->belongsTo('App\License');
	}
}