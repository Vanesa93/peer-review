<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Courses;
use DB;
use Auth;
use App\User;

class StudentCoursesController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $studentId = Auth::user()->id;
        //id- groups_to_students
        $courses = DB::table('groups_to_students')
                ->join('groups', 'groups_to_students.group_id', '=', 'groups.id')
                ->join('students', 'groups_to_students.student_id', '=', 'students.id')
                ->join('users', 'students.user_id_students', '=', 'users.id')
                ->join('courses', 'groups.course_id', '=', 'courses.id')
                ->where('users.id', $studentId)
                ->get();
        foreach ($courses as $course) {
            $forename = User::where('id', $course->tutor_id)->pluck('forename');
            $familyName = User::where('id', $course->tutor_id)->pluck('familyName');
            $course->tutor_name=$forename." ".$familyName;
        }
        return view('studentCourses.mycourses')->with('courses', $courses);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        //
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
