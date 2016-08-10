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

class GroupsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('notAdmin');
        $this->middleware('language');
    }

    public function create() {
        if (!empty(Session::get('locale'))) {
            $locale = Session::get('locale') . '_name';
        } else {
            $locale = 'en_name';
        }
        $faculties = $this->getFaculties($locale);
        $majors = [];
        $users = [];
        return view('groups.createGroups')
                        ->with('faculties', $faculties)
                        ->with('majors', $majors)
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
        $users= (object)$users;
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
    
     public function store(Request $request) {          
        $tutor_id = Auth::user()->id;
        $usersToGroup=$request->get('student_ids');
        $group = new Group([
            'tutor_id' =>$tutor_id,
            'faculty_id' => $request->get('faculty_id'),
            'major_id' => $request->get('major_id'),
            'student_first_year' => $request->get('student_first_year'),
            'course_id' => $request->get('course_id'),
        ]);
        $group->save();
        foreach($usersToGroup as $user){
            $groupToStudent=new GroupToStudent([
                'group_id'=>$group->id,
                'student_id'=>$user
            ]);

            $groupToStudent->save();
        }

        return redirect('groups');
    }

    public function index() {
        return view('groups.getGroups');
    }

}
