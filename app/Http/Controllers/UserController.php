<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;

class UserController extends Controller
{
    public function ajaxperson($name)
    {
        if(empty($name)){
            $persons = User::with('position')->with('department')->all();
        }else{
            $fullname = explode(' ', $name);

            if (count($fullname) > 1) {
                $persons = User::where('person_firstname', 'like', '%' .$fullname[0]. '%')
                            ->where('person_lastname', 'like', '%' .$fullname[1]. '%')
                            ->whereNotIn('person_state', [6,7,8,9,99])
                            ->with('position')
                            ->with('memberOf')
                            ->get();
            } else {
                $persons = User::where('person_firstname', 'like', '%' .$name. '%')
                            ->whereNotIn('person_state', [6,7,8,9,99])
                            ->with('position')
                            ->with('memberOf')
                            ->get();
            }
        }

        $users = [];
        foreach ($persons as $person) {
            array_push($users, [
                'id'        => $person->person_id,
                'name'      => $person->person_firstname. ' ' .$person->person_lastname,
                'position'  => $person->position->position_name,
                'ward'      => !empty($person->memberOf->division)
                                ? $person->memberOf->division->ward_name
                                : $person->memberOf->depart->depart_name,
            ]);
        }

        return $users;
    }

    public function ajaxpersons()
    {
        return [
            'persons'   => User::with('position', 'prefix')
                            ->where('position_id', '104')
                            ->where('person_state', '1')
                            ->get()
        ];
    }
}
