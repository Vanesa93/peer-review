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

    public function validator(array $data) {
        return Validator::make($data, [
                    'forename' => 'required|max:255',
                    'email' => 'required|email|max:255|unique:users',
                    'password' => 'required|confirmed|min:6',
                    'account_type' => 'required',
                    'mobile' => 'required'
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    public function create(Request $data) {
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
//        $user = User::find($id);
//
//        if ($user->account_type = 1) {
//            $user = DB::table('users')
//                    ->where('id',$id)
//                    ->join('lecturer', 'users.id', '=', 'lecturer.user_id_lecturer')
//                    ->get();
//            dd($user);
//        } elseif ($user->account_type = 2) {
//            $user = DB::table('students')
//                    ->join('users', 'students.user_id_students', '=', 'users.id')
//                    ->get();
//        } else {
//            return redirect()->back();
//        }
//        dd($user);
//
//
//        return ('users.editUsers');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        //
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
