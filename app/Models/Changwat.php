<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Changwat extends Model
{
	protected $connection = 'vehicle';

	protected $table = 'changwat';

	public function vehicle()
	{
		return $this->hasMany('App\Models\Vehicle', 'reg_chw', 'chw_id');
	}

	public function location()
	{
        return $this->hasMany('App\Location', 'changwat', 'chw_id');
    }
}
