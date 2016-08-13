<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Registrar;
use Illuminate\Http\Request;
use App\User;
use DB;
use App\Faculty;
use Input;
use App\Major;
use Session;
use Response;

class MajorsController extends Controller {
    
     public function __construct(Registrar $registrar) {
        $this->middleware('admin');
        $this->middleware('auth');
        $this->registrar = $registrar;
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
    
     public function addMajor($id) {
        if (!empty(Session::get('locale'))) {
            $locale = Session::get('locale') . '_name';
        } else {
            $locale = 'en_name';
        }
        $faculty = Faculty::find($id);
        $facultyName = $faculty->$locale;
        return view('admin.addMajor')->with('faculty', $faculty)->with('locale', $locale)
                        ->with('facultyName', $facultyName);
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

   


    public function removeMajor($id) {

        $major = Major::find($id);
        $major->delete();
        Session::flash('message', 'Successfully deleted !');
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
    
        public function getMajorsForRegister(Request $request) {
        $majors = Major::where('faculty_id', $request->get('facId'))->get();
        if ($majors->isEmpty()) {
            $message = "No majors for these faculty. Please choose another";
            return Response::json(array(
                        'success' => false,
                        'message' => $message,
            ));
        }
        $facultyColumnName = Session::get('locale') . '_name';
        if (empty(Session::get('locale'))) {
            $facultyColumnName = 'en_name';
        }
        foreach ($majors as $major) {
            $major->name = $major->$facultyColumnName;
        }
        return Response::json(array(
                    'success' => true,
                    'majors' => $majors,
        ));
    }
    
    public function createMajorWithAllFaculties() {
        if (!empty(Session::get('locale'))) {
            $locale = Session::get('locale') . '_name';
        } else {
            $locale = 'en_name';
        }
        $faculties= Faculty::all();
        foreach($faculties as $faculty){
            $faculty->name=$faculty->$locale;
            
        }
        return view('admin.majorsForAllFaculties')->with('faculties', $faculties)->with('locale', $locale);
    }


}
