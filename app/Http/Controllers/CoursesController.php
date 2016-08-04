<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Courses;

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
        return view('courses.courses');
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

        $course = new Courses([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'language' => $request->get('language'),
            'requirments' => $request->get('requirments'),
            'duration' => $request->get('duration')
        ]);

        $course->save();

        return redirect('courses');

//        $category = new Category;
//
//        $category->name = $request->get('name');
//
//        $category->save();
//
//        return \Redirect::route('categories.show', array($category->id))
//                        ->with('message', 'Your category has been created!');
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
