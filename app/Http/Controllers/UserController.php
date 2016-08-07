<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Input;
use App\User;
use App\Lecturer;
use App\Students;
use Validator;
use DB;
use Session;
use Redirect;

class UserController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('language');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function register() {
        return view('admin.register');
    }

    public function index() {
        //
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(Request $data) {
        $rules = array(
            'username' => 'required||unique:users',
            'forename' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
            'account_type' => 'required',
            'mobile' => 'required'
        );

        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return \Redirect::to('register')
                            ->withErrors($validator);
        } else {
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
                    'year' => $data['year'],
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
            return redirect('users');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $user = User::find($id);
        $sessionLanguage = Session::get('locale') . '_name';
        if (empty(Session::get('locale'))) {
            $sessionLanguage = 'en_name';
        }
        $userAccountType = DB::table('account_types')->where('account_type', $user->account_type)->pluck($sessionLanguage);
        $user = $this->lecturerOrUser($user);
        if ($user->account_type == 1) {
            $userId = $user->user_id_lecturer;
        } elseif ($user->account_type == 2) {
            $userId = $user->user_id_students;
        }
        if (!empty($user)) {
            return view('users.editUser')->with('user', $user)->with('userAccountType', $userAccountType)->with('userId', $userId);
        } else {
            return redirect()->back();
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $rules = array(
            'username' => 'required',
            'forename' => 'required|max:255',
            'email' => 'required|max:255',
            'mobile' => 'required'
        );

        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return \Redirect::to('users/edit/' . $id)
                            ->withErrors($validator);
        } else {
            $user = User::find($id);
            if (!empty($user)) {
                $user->username = Input::get('username');
                $user->forename = Input::get('forename');
                $user->familyName = Input::get('familyName');
                $user->email = Input::get('email');
                $user->save();
                $accounTypeAdditionlData = $this->lecturerOrUserData($user, Input::all());
            } else {
                return redirect()->back();
            }


            return \Redirect::to('users');
        }
    }

    private function lecturerOrUser($user) {
        if ($user->account_type == 1) {
            $lecturers = DB::table('users')
                    ->join('lecturer', 'users.id', '=', 'lecturer.user_id_lecturer')
                    ->where('users.account_type', 1)
                    ->get();
            foreach ($lecturers as $lecturer) {
                if ($lecturer->user_id_lecturer == $user->id) {
                    $user = $lecturer;
                }
            }
        } elseif ($user->account_type == 2) {
            $students = DB::table('users')
                    ->join('students', 'users.id', '=', 'students.user_id_students')
                    ->where('users.account_type', 2)
                    ->get();
            foreach ($students as $student) {
                if ($student->user_id_students == $user->id) {
                    $user = $student;
                }
            }
        }
        return $user;
    }

    private function lecturerOrUserData($user, $input) {
        if ($user->account_type == 1) {
            $additionalData = Lecturer::where('user_id_lecturer', $user->id)->first();
            $additionalData->mobile = Input::get('mobile');
            $additionalData->cabinet = Input::get('cabinet');
            $additionalData->department = Input::get('department');
            $additionalData->degree = Input::get('degree');
            $additionalData->save();
        } elseif ($user->account_type == 2) {
            $additionalData = Students::where('user_id_students', $user->id)->first();
            $additionalData->year = Input::get('year');
            $additionalData->semester = Input::get('semester');
            $additionalData->group = Input::get('group');
            $additionalData->department = Input::get('department');
            $additionalData->degree = Input::get('degree');
            $additionalData->mobile = Input::get('mobile');
            $additionalData->faculty = Input::get('faculty');
            $additionalData->save();
        }
        return $additionalData;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
