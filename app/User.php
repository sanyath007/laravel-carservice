<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
//    protected $fillable = [
//        'name', 'email', 'password',
//    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
//    protected $hidden = [
//        'person_password'
//    ];
    
    protected $connection = 'person';

    protected $table = 'personal';

    protected $primaryKey = 'person_id';

    protected $keyType = 'string';

    /** จุดปฏิบัติงาน */
    public function office()
    {
        return $this->belongsTo('App\Ward', 'office_id', 'ward_id');
    }

    public function memberOf()
    {
        return $this->belongsTo(Models\MemberOf::class, 'person_id', 'person_id');
    }

    public function position()
    {
        return $this->belongsTo('App\Position', 'position_id', 'position_id');
    }

    public function academic()
    {
        return $this->belongsTo('App\Academic', 'ac_id', 'ac_id');
    }

    public function prefix()
    {
        return $this->belongsTo('App\Prefix', 'person_prefix', 'prefix_id');
    }

    public function driver()
    {
        return $this->hasOne('App\Models\Driver', 'person_id', 'person_id');
    }

    public function maintained()
    {
        return $this->hasMany('App\Models\Maintenance', 'staff', 'person_id');
    }

    public function reservation()
    {
        return $this->hasMany('App\Models\Reservation', 'user_id', 'person_id');
    }

    public function passenger()
    {
        return $this->hasMany('App\Models\ReservePassenger', 'person_id', 'person_id');
    }

    public function survey()
    {
        return $this->hasMany('App\Models\Survey', 'user_id', 'person_id');
    }
}
