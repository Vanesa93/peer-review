<?php

namespace App\Services;

use App\User;
use Validator;
use Illuminate\Contracts\Auth\Registrar as RegistrarContract;

class Registrar implements RegistrarContract {

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    public function validator(array $data) {
        return Validator::make($data, [
                    'forename' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(array $data) {
        $user = User::create([
                    'username' => $data['username'],
                    'forename' => $data['forename'],
                    'familyName'=>$data['familyName'],
                    'email' => $data['email'],
                    'password' => bcrypt($data['password']),
                    'cabinet' => $data['cabinet'],
                    'facNumber' => $data['facNumber'],
                    'semester' => $data['semester'],
                    'group' => $data['group'],
                    'department' => $data['department'],
                    'degree' => $data['degree'],
                    'mobile' => $data['mobile'],
                    'position' => $data['position'],
                    'faculty'=>$data['faculty']
        ]);



        return $user;
    }

}
