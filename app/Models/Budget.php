<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Budget extends Model
{
  protected $connection = 'vehicle';

  protected $table = 'budget';
  
}
