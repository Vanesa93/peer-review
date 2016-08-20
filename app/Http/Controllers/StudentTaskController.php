<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use DB;
use App\User;
use App\Courses;
use App\Tasks;
use App\Fileentry;
use App\Group;
use App\TasksSolutions;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Input;

class StudentTaskController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $studentId = Auth::user()->id;
        //id- users
        $tasks = DB::table('task_to_students')
                ->join('tasks', 'task_to_students.task_id', '=', 'tasks.id')
                ->join('students', 'task_to_students.student_id', '=', 'students.id')
                ->join('users', 'students.user_id_students', '=', 'users.id')
                ->where('users.id', $studentId)
                ->get();
        foreach ($tasks as $task) {
            $forename = User::where('id', $task->tutor_id)->pluck('forename');
            $familyName = User::where('id', $task->tutor_id)->pluck('familyName');
            $task->tutor_name = $forename . " " . $familyName;
            $task->course_name = Courses::where('id', $task->course_id)->pluck('name');
        }
        return view('studentTasks.mytasks')->with('tasks', $tasks);
    }

    public function getfilesForTask($id) {

        $task = Tasks::find($id);
        $files = Fileentry::where('task_id', $id)->where('tutor_id', Auth::user()->id)->get();
        return view('studentTasks.files', compact('files', 'task'));
    }

    public function uploadFileToTask($id) {
        $task = Tasks::find($id);
        return view('studentTasks.upload')->with('task', $task);
    }

    public function upload(Request $file, $task) {
        $rules = array(
            'filefield' => 'max:50000|mimes:doc,docx,jpeg,png,xlsm,xlsx,jpg,jpg,bmp,pdf'
        );


        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $linkBack = 'mytasks/' . $task . '/upload';
            return Redirect::to($linkBack)
                            ->withErrors($validator);
        } else {
            $thisTask = Tasks::find($task);
            $fileentry = $file->file('filefield');
            $studentId = Auth::user()->id;
            $uploadedSolution = TasksSolutions::where('task_id', $task)->where('student_id', $studentId)->first();
            if (empty($uploadedSolution)) {
                $this->saveSolution($fileentry, $thisTask, $studentId);
            } else {
                $this->deleteFileFromTask($uploadedSolution->filename);
                $this->saveSolution($fileentry, $thisTask, $studentId);
            }
            return Redirect::to('mytasks');
        }
    }

    private function saveSolution($file, $task, $studentId) {
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename() . '.' . $extension, File::get($file));
        $today = Carbon::today();
        $entry = new TasksSolutions();
        $entry->mime = $file->getClientMimeType();
        $entry->original_filename = $file->getClientOriginalName();
        $entry->filename = $file->getFilename() . '.' . $extension;
        $entry->student_id = $studentId;
        $entry->task_id = $task->id;
        $entry->extension = $extension;
        $entry->sent_at = $today;
        $entry->save();
    }

    private function deleteFileFromTask($filename) {
        TasksSolutions::where('student_id', Auth::user()->id)->where('filename', $filename)->delete();
        unlink(storage_path('app/' . $filename));
        return "true";
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
        $task = Tasks::find($id);
        $task->course_name = Courses::where('id', $task->course_id)->pluck('name');
        $task->group_name = Group::where('id', $task->group_id)->pluck('name');
        return view('studentTasks.view')->with('task', $task);
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
