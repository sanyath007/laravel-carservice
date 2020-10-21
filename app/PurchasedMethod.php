<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class PurchasedMethod extends Model
{
  	protected $connection = 'vehicle';
  	protected $table = 'purchased_methods';
	protected $primaryKey = 'method_id';

	public function vehicle()
	{
	    return $this->hasMany('App\Vehicle', 'method_id', 'purchased_method');
	}
}
