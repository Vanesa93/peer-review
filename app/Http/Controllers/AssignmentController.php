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
            'group_ids' => 'required|max:100',
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
            'sent_at' => $today,
        ]);
        $task->save();
        $taskToGroups = $request->get('group_ids');
        foreach ($taskToGroups as $group) {
            $taskToStudent = new TasksToStudents([
                'group_id' => $group,
                'tutor_id' => $tutor_id,
                'task_id' => $task->id,
                'ready' => 0
            ]);
            $taskToStudent->save();
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
        $allGroups = Group::all();
        $groups = TasksToStudents::where('task_id', $task->id)->get();
        foreach ($groups as $group) {
            $group->name = Group::where('id', $group->group_id)->pluck('name');
        }
        return view('tasks.edit')->with('task', $task)->with('courses', $courses)->with('groups', $groups)->with('allGroups', $allGroups);
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
            'group_ids' => 'required|max:100',
        );
        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return \Redirect::to('tasks/'.$id.'/edit')
                            ->withErrors($validator);
        } else {
            $task = Tasks::find($id);
            $task->name = Input::get('name');
            $task->description = Input::get('description');
            $endDate = Carbon::parse(Input::get('end_date'));
            $task->end_date = $endDate;
            $task->course_id = Input::get('course_id');
            $task->save();
            $updatedGroups = Input::get('group_ids');
            $groupToTasksToDelete = TasksToStudents::where('task_id', $id)->get();
            $groupToTasks[] = TasksToStudents::where('task_id', $id)->pluck('group_id');
            foreach ($groupToTasksToDelete as $oldId) {
                if (in_array($oldId->group_id, $updatedGroups)) {
                    
                } else {
                    $oldId->delete();
                }
            }
            foreach ($updatedGroups as $newId) {
                if (in_array($newId, $groupToTasks)) {
                    
                } else {
                    $newTask = new TasksToStudents([
                        'task_id' => $id,
                        'group_id' => $newId,
                        'ready' => 0
                    ]);
                    $newTask->save();
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

        $assignedStudents = TasksToStudents::where('task_id', $id)->get();
        dd($assignedStudents);
    }

}
