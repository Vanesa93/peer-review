<?php

namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;
use DB;
use App\Lecturer;
use App\Students;

class Registrar implements RegistrarContract {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data) {
        return Validator::make($data, [
//                    'forename' => 'required|max:255',
//                    'email' => 'required|email|max:255|unique:users',
//                    'password' => 'required|confirmed|min:6',
//                    'position' => 'required',
//                    'mobile' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data) {

        $user = new User([
            'account_type' => $data['account_type'],
            'username' => $data['username'],
            'forename' => $data['forename'],
            'familyName' => $data['familyName'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
                //account_type 1 - lecturer, 2- student
        ]);
        $user->save();
        if ($data['account_type'] == 1) {
            $lecturer = new Lecturer([
                'cabinet' => $data['cabinet'],
                'department' => $data['department'],
                'degree' => $data['degree'],
                'mobile' => $data['mobile'],
            ]);
            $lecturer->user_id_lecturer = $user->id;
            $lecturer->save();
        } else {
            $student = new Students([
                'facNumber' => $data['facNumber'],
                'semester' => $data['semester'],
                'group' => $data['group'],
                'department' => $data['department'],
                'degree' => $data['degree'],
                'mobile' => $data['mobile'],
                'faculty' => $data['faculty']
            ]);
            $student->user_id_students = $user->id;
            $student->save();
        }
        return $user;
    }

}
