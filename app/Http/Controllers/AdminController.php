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
use Input;
use App\Major;
use Session;

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
        $faculties = Faculty::all();
        return view('admin.faculties')->with('faculties', $faculties);
    }

    public function getMajors($facultyId) {
        $majors = Major::where('faculty_id', $facultyId)->get();
        $faculty = Faculty::find($facultyId);
        $facultyColumnName = Session::get('locale') . '_name';
        if (empty(Session::get('locale'))) {
            $facultyColumnName = 'en_name';
        }
        $facultyName = DB::table('faculties')->where('id', $facultyId)->pluck($facultyColumnName);
        return view('admin.majors')->with('majors', $majors)->with('faculty', $faculty)
                        ->with('facultyName', $facultyName);
    }

    public function addFaculty() {
        return view('admin.addFaculty');
    }

    public function editFaculty($id) {
        $faculty = Faculty::find($id);
        return view('admin.editFaculty')->with('faculty', $faculty);
    }

    public function editMajor($id) {
        $major = Major::find($id);


        $facultyColumnName = Session::get('locale') . '_name';
        if (empty(Session::get('locale'))) {
            $facultyColumnName = 'en_name';
        }
        $faculties = Faculty::lists($facultyColumnName, 'id');

        $choosenFaculty = Faculty::where('id', $major->faculty_id)->lists('id', $facultyColumnName);

        return view('admin.editMajor')->with('major', $major)->with('faculties', $faculties)
                        ->with('choosenFaculty', $choosenFaculty);
    }

    public function updateFaculty($id) {

        $rules = array(
            'bg_name' => 'required|max:100',
            'en_name' => 'required|max:100',
            'de_name' => 'required|max:100',
        );
        $validator = \Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return \Redirect::to('faculties/edit/' . $id)
                            ->withErrors($validator);
        } else {
            $faculty = Faculty::find($id);
            $faculty->bg_name = Input::get('bg_name');
            $faculty->en_name = Input::get('en_name');
            $faculty->de_name = Input::get('de_name');
            $faculty->save();

            return \Redirect::to('faculties');
        }
    }

    public function updateMajor($id) {

        $rules = array(
            'faculty_id' => 'required',
            'bg_name' => 'required|max:100',
            'en_name' => 'required|max:100',
            'de_name' => 'required|max:100',
        );
        $validator = \Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return \Redirect::to('major/edit/' . $id)
                            ->withErrors($validator);
        } else {
            $major = Major::find($id);
            $major->faculty_id = Input::get('faculty_id');
            $major->bg_name = Input::get('bg_name');
            $major->en_name = Input::get('en_name');
            $major->de_name = Input::get('de_name');
            $major->save();

            return \Redirect::to('faculties');
        }
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

    public function storeMajor(Request $request) {
        $facultyId = $request->get('faculty_id');
        $faculty = new Major([
            'faculty_id' => $request->get('faculty_id'),
            'bg_name' => $request->get('bg_name'),
            'en_name' => $request->get('en_name'),
            'de_name' => $request->get('en_name'),
        ]);
        $faculty->save();

        return redirect('majors/' . $facultyId);
    }

    public function addMajor() {
        $faculties = Faculty::all();
        if (!empty(Session::get('locale'))) {
            $locale = Session::get('locale') . '_name';
        } else {
            $locale = 'en_name';
        }
        return view('admin.addMajor')->with('faculties', $faculties)->with('locale', $locale);
    }

    public function removeFaculty($id) {

        $faculty = Faculty::find($id);
        $faculty->delete();
        $majors=  Major::where('faculty_id',$id)->get();
        foreach ($majors as $major){
            $major->delete();
        }
        Session::flash('message', 'Successfully deleted !');
    }
    
    
    public function removeMajor($id) {

        $major = Major::find($id);
        $major->delete();
        Session::flash('message', 'Successfully deleted !');
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
