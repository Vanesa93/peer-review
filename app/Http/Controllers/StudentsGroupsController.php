<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Auth;
use App\User;
use DB;
use App\Courses;
use App\Faculty;
use App\Major;
use Session;

class StudentsGroupsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('notAdmin');
        $this->middleware('language');
        $this->middleware('student');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    private function getLocale() {
        if (!empty(Session::get('locale'))) {
            $locale = Session::get('locale') . '_name';
        } else {
            $locale = 'en_name';
        }

        return $locale;
    }

    public function index() {
        $studentId = Auth::user()->id;
        $locale = $this->getLocale();
        //id- groups_to_students
        $groups = DB::table('groups_to_students')
                ->join('groups', 'groups_to_students.group_id', '=', 'groups.id')
                ->join('students', 'groups_to_students.student_id', '=', 'students.id')
                ->join('users', 'students.user_id_students', '=', 'users.id')
                ->where('users.id', $studentId)
                ->get();
        foreach ($groups as $group) {
            $forename = User::where('id', $group->tutor_id)->pluck('forename');
            $familyName = User::where('id', $group->tutor_id)->pluck('familyName');
            $group->tutor_name = $forename . " " . $familyName;
            $group->course_name = Courses::where('id', $group->course_id)->pluck('name');
            $group->faculty_name = Faculty::where('id', $group->faculty_id)->pluck($locale);
            $group->major_name = Major::where('id', $group->major_id)->pluck($locale);
        }
        return view('studentGroups.mygroups')->with('groups', $groups);
    }
}
