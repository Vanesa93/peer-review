<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Courses;
use Auth;
use Input;
use Session;

class CoursesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('notAdmin');
        $this->middleware('language');
        $this->middleware('tutor');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $userId = Auth::user()->id;
        $courses = Courses::where('tutor_id', $userId)->get();
        return view('courses.courses')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        return view('courses.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Requests\CreateCoursesFormRequest $request) {
       
        $userId = Auth::user()->id;
        $course = new Courses([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'language' => $request->get('language'),
            'requirments' => $request->get('requirments'),
            'duration' => $request->get('duration'),
        ]);
        $course->tutor_id = $userId;
        $course->save();

        return redirect('courses');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        $course = Courses::find($id);
        return view('courses.edit')->with('course', $course);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        
        $rules = array(
            'name' => 'required|max:100',
            'description' => 'required|max:1000',
            'language' => 'required|max:100',
            'duration' => 'max:100',
            'requirments' => 'max:100',
        );
        
        $validator = \Validator::make(Input::all(), $rules);
        // process the login
        if ($validator->fails()) {
            return \Redirect::to('courses/edit/' . $id)
                            ->withErrors($validator);
        } else {
            $course =  Courses::find($id);
            $course->name = Input::get('name');
            $course->description = Input::get('description');
            $course->language = Input::get('language');
            $course->duration=Input::get('duration');
            $course->requirments=Input::get('requirments');
            $course->save();

            return \Redirect::to('courses');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        
        $course = Courses::find($id);
        $course->delete();
        Session::flash('message', 'Successfully deleted the nerd!');
    }

}
