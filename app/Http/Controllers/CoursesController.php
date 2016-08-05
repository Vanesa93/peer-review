<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Courses;
use Auth;

class CoursesController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('language');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $userId = Auth::user()->id;
        $courses = Courses::where('tutor_id',$userId)->get();
        return view('courses.courses')->with('courses',$courses);
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
    public function edit() {
        return view('courses.edit');
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
