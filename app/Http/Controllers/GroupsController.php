<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Faculty;
use App\Major;
use App\User;
use DB;
use Input;
use Session;
use App\Group;
use App\GroupToStudent;
use Illuminate\Http\Response;
use Auth;
use App\Courses;

class GroupsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('notAdmin');
        $this->middleware('language');
    }

    public function create() {
        $tutorId = Auth::user()->id;
        $locale=$this->getLocale();
        $faculties = $this->getFaculties($locale);
        $courses = Courses::where('tutor_id', $tutorId)->get();
        $majors = [];
        $users = [];
        return view('groups.createGroups')
                        ->with('faculties', $faculties)
                        ->with('majors', $majors)
                        ->with('courses', $courses)
                        ->with('users', $users);
    }

    private function getFaculties($locale) {
        $faculties = Faculty::all();
        foreach ($faculties as $faculty) {
            $faculty->name = $faculty->$locale;
        }
        return $faculties;
    }

    public function getGroupMajors(Request $request) {
        $majors = Major::where('faculty_id', $request->get('facId'))->get();

        if ($majors->isEmpty()) {
            $message = "No majors for these faculty. Please choose another";
            return \Response::json(array(
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
        return \Response::json(array(
                    'success' => true,
                    'majors' => $majors,
        ));
    }

    public function getUsersGroup(Request $request) {
        $faculty = $request->get('facId');
        $major = $request->get('majorId');
        $users = DB::table('users')
                ->join('students', 'users.id', '=', 'students.user_id_students')
                ->where('users.account_type', 2)
                ->where('faculty', $faculty)
                ->where('major', $major)
                ->get();
        $users = (object) $users;
        if (empty($users)) {
            $message = "No users found.";
            return \Response::json(array(
                        'success' => false,
                        'message' => $message,
            ));
        }

        return \Response::json(array(
                    'success' => true,
                    'users' => $users,
        ));
    }

    public function getUsersGroupWithYear(Request $request) {
        $faculty = $request->get('facId');
        $major = $request->get('majorId');
        $year = $request->get('year');
        $users = $this->getUsers($faculty, $major, $year);
        if (empty($users)) {
            $message = "No users found.";
            return \Response::json(array(
                        'success' => false,
                        'message' => $message,
            ));
        }
        return \Response::json(array(
                    'success' => true,
                    'users' => $users,
        ));
    }

    private function getUsers($faculty, $major, $year) {
        $users = DB::table('users')
                ->join('students', 'users.id', '=', 'students.user_id_students')
                ->where('users.account_type', 2)
                ->where('faculty', $faculty)
                ->where('major', $major)
                ->where('year', $year)
                ->get();
        return (object) $users;
    }

    public function store(Request $request) {
        $rules = array(
            'name' => 'required|max:100',
            'faculty_id' => 'required|max:1000',
            'major_id' => 'required|max:100',
            'student_first_year' => 'max:100',
            'course_id' => 'max:100',
            'student_ids' => 'required|max:100',
        );
        $validator = \Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return \Redirect::to('groups/create')
                            ->withErrors($validator);
        } else {
            return $this->saveGroup($request);
        }
    }

    private function saveGroup($request) {

        $tutor_id = Auth::user()->id;
        $usersToGroup = $request->get('student_ids');
        $group = new Group([
            'tutor_id' => $tutor_id,
            'name' => $request->get('name'),
            'faculty_id' => $request->get('faculty_id'),
            'major_id' => $request->get('major_id'),
            'student_first_year' => $request->get('student_first_year'),
            'course_id' => $request->get('course_id'),
        ]);
        $group->save();
        foreach ($usersToGroup as $user) {
            $groupToStudent = new GroupToStudent([
                'group_id' => $group->id,
                'student_id' => $user
            ]);

            $groupToStudent->save();
        }
        return redirect('groups');
    }
    
    private function getLocale() {
        if (!empty(Session::get('locale'))) {
            $locale = Session::get('locale') . '_name';
        } else {
            $locale = 'en_name';
        }
        
        return $locale;        
    }
    
    public function index() {
        $tutor = Auth::user();
        $locale=$this->getLocale();        
        $groups = Group::where('tutor_id', $tutor->id)->get();
        foreach($groups as $group){
            $group->faculty_id =  Faculty::where('id',$group->faculty_id)->pluck($locale);
            $group->major_id=  Major::where('id',$group->major_id)->pluck($locale);
            $group->course_id=  Courses::where('id',$group->course_id)->pluck('name');
        }

        return view('groups.getGroups')->with('groups', $groups);
    }

    public function edit($id) {
        $group = Group::find($id);
        return view('groups.edit')->with('group', $group);
    }

    public function update($id) {
        $rules = array(
            'name' => 'required|max:100',
            'faculty_id' => 'required|max:1000',
            'major_id' => 'required|max:100',
            'student_first_year' => 'max:100',
            'course_id' => 'max:100',
            'users' => 'required|max:100',
        );
        $validator = \Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return \Redirect::to('groups/edit/' . $id)
                            ->withErrors($validator);
        } else {
            $course = Courses::find($id);
            $course->name = Input::get('name');
            $course->description = Input::get('description');
            $course->language = Input::get('language');
            $course->duration = Input::get('duration');
            $course->requirments = Input::get('requirments');
            $course->save();

            return \Redirect::to('courses');
        }
    }

}
