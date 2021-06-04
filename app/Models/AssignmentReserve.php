<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AssignmentReserve extends Model
{
    protected $connection = 'vehicle';
    protected $table = 'assignment_reserve';

    public function assignment()
    {
        return $this->belongsTo('App\Models\Assignment', 'assign_id', 'id');
    }
}
