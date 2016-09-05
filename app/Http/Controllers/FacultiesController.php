<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Services\Registrar;
use Illuminate\Http\Request;
use App\Faculty;
use Input;
use App\Major;
use Session;

class FacultiesController extends Controller {

    public function __construct(Registrar $registrar) {
        $this->middleware('admin');
        $this->middleware('auth');
        $this->middleware('language');
    }

    public function getFaculties() {
        $faculties = Faculty::all();
        return view('admin.faculties')->with('faculties', $faculties);
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

    public function removeFaculty($id) {
        dd(\App\Students::all());
        $faculty = Faculty::find($id);
        $faculty->delete();
        $majors = Major::where('faculty_id', $id)->get();
        foreach ($majors as $major) {
            $major->delete();
        }
        Session::flash('message', 'Successfully deleted !');
    }

    public function editFaculty($id) {
        $faculty = Faculty::find($id);
        return view('admin.editFaculty')->with('faculty', $faculty);
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

}
