<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use DB;
use Session;
use App\Lecturer;
use App\Students;
use App\Faculty;
use App\Major;

class MyProfileController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('notAdmin');
        $this->middleware('language');
    }

    public function getProfileData($id) {
        $user = User::where('id', $id)->first();
        if (!empty($user)) {
            if ($user->account_type === 1) {
                $userData = DB::table('users')
                        ->join('lecturer', 'users.id', '=', 'lecturer.user_id_lecturer')
                        ->where('lecturer.user_id_lecturer', $id)
                        ->get();
            } elseif ($user->account_type === 2) {
                $userData = DB::table('users')
                        ->join('students', 'users.id', '=', 'students.user_id_students')
                        ->where('students.user_id_students', $id)
                        ->get();
                $facultyColumnName = Session::get('locale') . '_name';
                if (empty(Session::get('locale'))) {
                    $facultyColumnName = 'en_name';
                }
                foreach ($userData as $student) {
                    $student->faculty = Faculty::where('id', $student->faculty)->pluck($facultyColumnName);
                    $student->major = Major::where('id', $student->major)->pluck($facultyColumnName);
                }
            }
        }
        return view('auth.myProfile')->with('userData', $userData[0]);
    }

}
