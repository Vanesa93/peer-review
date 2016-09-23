<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\User;
use DB;
use Session;
use Input;
use App\Faculty;
use App\Major;
use Redirect;
use Auth;
use Hash;
use Request; 

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

    public function changePassword() {
        return view('auth.changePassword');
    }

    public function resetPassword(Request $request) {
        $rules = array(
            'new_password' => 'required'
        );
        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('password')
                            ->withErrors($validator);
        } else {
            $user = Auth::user();           
            $user->password = bcrypt(Request::input('new_password'));
            $user->save();
            Session::flash('message', trans('messages.successChangePassword'));
            return redirect('password');
        }
    }
    
     public function checkOldPassword() {        
        $userPassword = User::where('id',Auth::user()->id)->first();
        $passwordCheck = Hash::check(Request::input('old_password'),$userPassword->password);
        if ($passwordCheck===true) {   // <-- if no database match
            return \Response::json(array('msg' => 'true'));
        }
        return \Response::json(array('msg' => 'false'));
    }

}
