<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Request;

class RegistrationController extends Controller {

    public function checkExistingUseraname() {
        $username = Request::input('username');
        $usernames= DB::table('users')->where('username', $username)->first();
        if (empty($usernames)) {   // <-- if no database match
            return \Response::json(array('msg' => 'true'));
        }
        return \Response::json(array('msg' => 'false'));
    }

    public function checkExistingEmail() {
        $email = Request::input('email');
        $emails = DB::table('users')->where('email', $email)->first();
        if (empty($emails)) {   // <-- if no database match
            return \Response::json(array('msg' => 'true'));
        }
        return \Response::json(array('msg' => 'false'));
    }

    public function checkExistingFacNumber() {
        $facNumber = Request::input('facNumber');
        $facNumbersStudents = DB::table('students')->where('facNumber', $facNumber)->first();
        if (empty($facNumbersStudents)) {   // <-- if no database match
            return \Response::json(array('msg' => 'true'));
        }
        return \Response::json(array('msg' => 'false'));
    }

}
