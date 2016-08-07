<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Services\Registrar;
use Illuminate\Http\Request;
use App\User;
use App\Lecturer;
use App\Students;
use Validator;
use DB;
use App\Faculty;

class AdminController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function __construct(Registrar $registrar) {
        $this->middleware('admin');
        $this->registrar = $registrar;
    }

    public function getFaculties() {
        return view('admin.faculties');
    }

    public function getMajors() {
        return view('admin.majors');
    }

    public function addFaculty() {
        return view('admin.addFaculty');
    }

    public function storeFaculty(Request $request) {
        $faculty = new Faculty([
            'bg_name' => $request->get('bg_name'),
            'en_name' => $request->get('en_name'),
            'de_name' => $request->get('en_name'),
         
        ]);
        $faculty->save();

        return redirect('faculties');
    }

    public function addMajor() {
        return view('admin.addMajor');
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
    public function create($id) {
        
    }

    public function getUsers() {
        $lecturers = DB::table('users')
                ->join('lecturer', 'users.id', '=', 'lecturer.user_id_lecturer')
                ->where('users.account_type', 1)
                ->get();
        $students = DB::table('users')
                ->join('students', 'users.id', '=', 'students.user_id_students')
                ->where('users.account_type', 2)
                ->get();
        return view('admin.users')->with('lecturers', $lecturers)->with('students', $students);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */

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
        //
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
