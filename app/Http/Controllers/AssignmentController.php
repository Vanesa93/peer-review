<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Group;
use App\GroupToStudent;
use Auth;
use App\Courses;
use Illuminate\Support\Facades\Response;
use Carbon\Carbon;
use Session;
use Illuminate\Support\Facades\Redirect;
use Input;
use App\Tasks;
use App\TasksToStudents;
use DB;

class AssignmentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('notAdmin');
        $this->middleware('language');
    }

    private function getLocale() {
        if (!empty(Session::get('locale'))) {
            $locale = Session::get('locale') . '_name';
        } else {
            $locale = 'en_name';
        }

        return $locale;
    }

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $tutorId = Auth::user()->id;
        $tasks = Tasks::where('tutor_id', $tutorId)->get();
        foreach ($tasks as $task) {
            $task->course_id = Courses::where('id', $task->course_id)->pluck('name');
            $task->sent_at = Carbon::parse($task->sent_at)->format('d.m.Y');
            $task->end_date = Carbon::parse($task->end_date)->format('d.m.Y');
        }
        return view('tasks.tasks')->with('tasks', $tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $tutorId = Auth::user()->id;
        $groups = [];
        $courses = Courses::all();
        return view('tasks.create')->with('groups', $groups)->with('courses', $courses);
    }

    public function getGroupsForCourse(Request $request) {
        $groups = Group::where('course_id', $request->get('courseId'))->get();
        if ($groups->isEmpty()) {
            $message = "No groups for these course. Please choose another";
            return Response::json(array(
                        'success' => false,
                        'message' => $message,
                        'groups' => []
            ));
        }
        return Response::json(array(
                    'success' => true,
                    'groups' => $groups,
        ));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $rules = array(
            'name' => 'required|max:100',
            'description' => 'required|max:1000',
            'end_date' => 'required|max:100',
            'course_id' => 'required|max:100',
            'group_id' => 'required|max:100',
        );

        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('tasks/create')
                            ->withErrors($validator);
        } else {
            return $this->saveTask($request);
        }
    }

    private function saveTask($request) {
        $today = Carbon::today();
        $tutor_id = Auth::user()->id;
        $endDate = Carbon::parse($request->get('end_date'));
        $task = new Tasks([
            'tutor_id' => $tutor_id,
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'end_date' => $endDate,
            'course_id' => $request->get('course_id'),
            'group_id' => $request->get('group_id'),
            'sent_at' => $today,
        ]);
        $task->save();
        $groupsToStudents[] = GroupToStudent::where('group_id', $task->group_id)->get();

        foreach ($groupsToStudents as $groupToStudents) {
            foreach ($groupToStudents as $groupToStudent) {
                $taskToStudent = new TasksToStudents([
                    'task_id' => $task->id,
                    'student_id' => $groupToStudent->student_id,
                ]);
                $taskToStudent->save();
            }
        }

        return redirect('tasks');
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
        $task = Tasks::find($id);
        $task->course_name = Courses::where('id', $task->course_id)->pluck('name');
        $courses = Courses::all()->lists('name', 'id');
        $allGroups = Group::all()->lists('name', 'id');
        return view('tasks.edit')->with('task', $task)->with('courses', $courses)->with('allGroups', $allGroups);
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
            'end_date' => 'required|max:100',
            'course_id' => 'max:100',
            'group_id' => 'required|max:100',
        );
        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return \Redirect::to('tasks/' . $id . '/edit')
                            ->withErrors($validator);
        } else {
            $task = Tasks::find($id);
            $task->name = Input::get('name');
            $task->description = Input::get('description');
            $endDate = Carbon::parse(Input::get('end_date'));
            $task->end_date = $endDate;
            $task->course_id = Input::get('course_id');
            $task->group_id = Input::get('group_id');
            $task->save();

            $updatedUsersIds = Input::get('student_ids');
            $newGroup = $task->group_id;

            $studentsFromNewGroup = GroupToStudent::where('group_id', $newGroup)->get();
            foreach ($studentsFromNewGroup as $newGroup) {
                $allStudentsToAdd[] = $newGroup->student_id;
                //all students, that must be added to group
            }
            $studentsTasksToDelete = TasksToStudents::where('task_id', $id)->get();
            $studentToTasks[] = TasksToStudents::where('task_id', $id)->pluck('student_id');
            foreach ($studentsTasksToDelete as $oldId) {
                if (in_array($oldId->student_id, $allStudentsToAdd)) {
                    
                } else {
                    $oldId->delete();
                }
            }
            foreach ($allStudentsToAdd as $newId) {
                if (in_array($newId, $studentToTasks)) {
                    
                } else {
                    $newStudent = new TasksToStudents([
                        'task_id' => $id,
                        'student_id' => $newId,
                    ]);
                    $newStudent->save();
                }
            }
        }
        return \Redirect::to('tasks');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {

        $taskToStudents = TasksToStudents::where('task_id', $id)->get();
        foreach ($taskToStudents as $taskToStudent) {
            $taskToStudent->delete();
        }
        $task = Tasks::find($id);
        $task->delete();

        Session::flash('message', 'Successfully deleted the nerd!');
    }

    public function getAssignedToTaskUsers($id) {
        $task = Tasks::find($id);
        $task->course_id = Courses::where('id', $task->course_id)->pluck('name');
        $students = DB::table('students')
                ->join('groups_to_students', 'students.id', '=', 'groups_to_students.student_id')
                ->join('users', 'students.user_id_students', '=', 'users.id')
                ->join('groups', 'groups_to_students.group_id', '=', 'groups.id')
                ->join('task_to_groups', 'groups.id', '=', 'task_to_groups.group_id')
                ->where('task_to_groups.task_id', $id)
                ->where('groups.tutor_id', Auth::user()->id)
                ->where('users.account_type', 2)
                ->get();
        return view('tasks.studentsToTasks')->with('students', $students)->with('task', $task);
    }

}
