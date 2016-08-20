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
use Storage;
use File;
use App\Fileentry;
use App\Lecturer;

class AssignmentController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('notAdmin');
        $this->middleware('language');
    }  

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $tutorId = Auth::user()->id;
        $lecturerId=  Lecturer::where('user_id_lecturer',$tutorId)->pluck('id');
        $tasks = Tasks::where('tutor_id', $lecturerId)->get();
        foreach ($tasks as $task) {
            $task->course_id = Courses::where('id', $task->course_id)->pluck('name');
            $task->sent_at = Carbon::parse($task->sent_at)->format('d.m.Y');
            $task->end_date = Carbon::parse($task->end_date)->format('d.m.Y');
            $task->group = Group::where('id', $task->id)->pluck('name');
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
        $courses = Courses::where('tutor_id',$tutorId)->get();
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
            'course_id' => 'required|max:100',
            'group_id' => 'required|max:100',
            'filefield' => 'max:50000|mimes:doc,docx,jpeg,png,xlsm,xlsx,jpg,jpg,bmp,pdf'
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
        $lecturerId=  Lecturer::where('user_id_lecturer',$tutor_id)->pluck('id');
        $endDate = Carbon::parse($request->get('end_date'));
        $task = new Tasks([
            'tutor_id' => $lecturerId,
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'end_date' => $endDate,
            'course_id' => $request->get('course_id'),
            'group_id' => $request->get('group_id'),
            'sent_at' => $today,
        ]);
        $task->save();
        $this->saveTaskToStudents($task);
        if (!empty($request->file('filefield'))) {
            $fileentry = $request->file('filefield');
            $this->saveFileEntryForLecturer($fileentry, $task);
        }
        return redirect('tasks');
    }

    private function saveTaskToStudents($task) {
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
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        $task = Tasks::find($id);
        $task->course_name = Courses::where('id', $task->course_id)->pluck('name');
        $task->group_name = Group::where('id', $task->group_id)->pluck('name');
        return view('tasks.view')->with('task',$task);
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
                ->join('task_to_students', 'students.id', '=', 'task_to_students.student_id')
                ->join('users', 'students.user_id_students', '=', 'users.id')
                ->where('task_to_students.task_id', $id)
                ->where('users.account_type', 2)
                ->get();
        return view('tasks.studentsToTasks')->with('students', $students)->with('task', $task);
    }

    public function getfilesForTask($id) {

        $task = Tasks::find($id);
        $lecturerId=  Lecturer::where('user_id_lecturer', Auth::user()->id)->pluck('id');
        $files = Fileentry::where('task_id', $id)->where('tutor_id',$lecturerId)->get();
        return view('tasks.files', compact('files', 'task'));
    }

    public function openFilesForTask($id, $filename) {
        $tutorId = Auth::user()->id;
        $lecturerId=  Lecturer::where('user_id_lecturer',$tutorId)->pluck('id');
        $entry = Fileentry::where('filename', '=', $filename)->where('tutor_id', $lecturerId)->where('id', $id)->firstOrFail();
        $file = Storage::disk('local')->get($entry->filename);

        return Response::make($file, 200, [
                    'Content-Type' => $entry->mime,
                    'Content-Disposition' => 'inline; filename="' . $entry->original_filename . '"',
        ]);
    }

    public function uploadFileToTask($id) {
        $task = Tasks::find($id);
        return view('tasks.upload')->with('task', $task);
    }

    public function upload(Request $file, $task) {
        $rules = array(
            'filefield' => 'max:50000|mimes:doc,docx,jpeg,png,xlsm,xlsx,jpg,jpg,bmp,pdf'
        );
        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $linkBack = 'tasks/' . $task . '/upload';
            return Redirect::to($linkBack)
                            ->withErrors($validator);
        } else {
            $thisTask = Tasks::find($task);
            $fileentry = $file->file('filefield');
            $this->saveFileEntryForLecturer($fileentry, $thisTask);
            return Redirect::to('tasks/' . $task . '/helpmaterials');
        }
    }

    private function saveFileEntryForLecturer($file, $task) {
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename() . '.' . $extension, File::get($file));
        $entry = new Fileentry();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename() . '.' . $extension;
        $entry->tutor_id = $task->tutor_id;
        $entry->task_id = $task->id;
        $entry->extension = $extension;
        $entry->save();
    }

    public function deleteFileFromTask($filename) {
        $tutorId = Auth::user()->id;
        $lecturerId=  Lecturer::where('user_id_lecturer',$tutorId)->pluck('id');
        Fileentry::where('tutor_id',$lecturerId)->where('filename', $filename)->delete();
        unlink(storage_path('app/' . $filename));
        return "true";
    }

}
