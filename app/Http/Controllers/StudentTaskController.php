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
use Illuminate\Support\Facades\Response;
use App\TasksToStudents;
use App\Lecturer;
use App\Students;
use App\StudentsReviews;
use App\QuestionaryToStudent;
use App\LecturersReviews;
use App\Grade;

class StudentTaskController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $userId = Auth::user()->id;
        $studentId=Students::where('user_id_students',$userId)->pluck('id');
        //id- users
        $taskInfo = DB::table('task_to_students')
                ->join('tasks', 'task_to_students.task_id', '=', 'tasks.id')
                ->join('students', 'task_to_students.student_id', '=', 'students.id')
                ->join('users', 'students.user_id_students', '=', 'users.id')
                ->join('lecturer', 'tasks.tutor_id', '=', 'lecturer.id')
                ->where('users.id', $userId)
                ->get();
        $tasks = $this->getTaskInfo($taskInfo,$studentId);
        return view('studentTasks.mytasks')->with('tasks', $tasks);
    }

    private function getTaskInfo($tasks,$studentId) {
        foreach ($tasks as $task) {
            $task->course_name = Courses::where('id', $task->course_id)->pluck('name');
            $this->getSolutins($task);
            $task->active = $this->checkEndDate($task);
            $forename = User::where('id', $task->user_id_lecturer)->pluck('forename');
            $familyName = User::where('id', $task->user_id_lecturer)->pluck('familyName');
            $task->tutor_name = $forename . " " . $familyName;
            $task->grade = Grade::where('task_id', $task->task_id)->where('student_id', $studentId)->pluck('grade');
            $task->uploaded_review=  StudentsReviews::where('task_id',$task->task_id)->where('student_id_writer',$studentId)->get();
       }
        return $tasks;
    }

    private function checkEndDate($task) {
        $today = Carbon::today();
        if ($today > $task->end_date) {
            return false;
        } else {
            return true;
        }
    }

    private function getSolutins($task) {
        $studentId = Students::where('user_id_students', Auth::user()->id)->pluck('id');
        $solution = TasksSolutions::where('student_id', $studentId)->where('task_id', $task->task_id)->first();
        if (!empty($solution)) {
            $task->file_id = $solution->id;
            $task->solution_filename = $solution->filename;
        } else {
            $task->file_id = "";
            $task->solution_filename = "";
        }
    }

    public function getfilesForTask($id) {
        $task = Tasks::find($id);
        $lecturerId = Lecturer::where('id', $task->tutor_id)->pluck('id');
        $files = Fileentry::where('task_id', $id)->where('tutor_id', $lecturerId)->get();
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
            $studentId = Students::where('user_id_students', Auth::user()->id)->pluck('id');
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
        $readyTask = TasksToStudents::where('student_id', $studentId)->where('task_id', $entry->task_id)->first();
        $readyTask->ready = 1;
        $readyTask->save();
    }

    private function deleteFileFromTask($filename) {
        $userId = Auth::user()->id;
        $studentId = Students::where('user_id_students', $userId)->pluck('id');
        TasksSolutions::where('student_id', $studentId)->where('filename', $filename)->delete();
        unlink(storage_path('app/' . $filename));
        return "true";
    }

    public function openSolution($id, $filename) {
        $userId = Auth::user()->id;
        $studentId = Students::where('user_id_students', $userId)->pluck('id');
        $entry = TasksSolutions::where('filename', '=', $filename)->where('student_id', $studentId)->where('id', $id)->firstOrFail();
        $file = Storage::disk('local')->get($entry->filename);

        return Response::make($file, 200, [
                    'Content-Type' => $entry->mime,
                    'Content-Disposition' => 'inline; filename="' . $entry->original_filename . '"',
        ]);
    }

    public function show($id) {
        $task = Tasks::find($id);
        $task->course_name = Courses::where('id', $task->course_id)->pluck('name');
        $task->group_name = Group::where('id', $task->group_id)->pluck('name');
        return view('studentTasks.view')->with('task', $task);
    }

    public function reviewToTask($taskId) {
        $review = StudentsReviews::where('task_id', $taskId)->first();
        $review->task_name = Tasks::where('id', $taskId)->pluck('name');
        $questionaryToStudent = QuestionaryToStudent::where('id', $review->questionary_to_student_id)->first();
        $lecturersReview = LecturersReviews::where('id', $questionaryToStudent->lecturers_review_id)->first();
        $review->questionaryToStudent=  Fileentry::where('id',$lecturersReview->file_id)->first();
        return view('studentTasks.reviews')->with('review', $review);
    }

    public function questionaryToTask($id, $filename) {
        $questionary = Fileentry::where('id', $id)->where('filename', '=', $filename)->first();
        $file = Storage::disk('local')->get($questionary->filename);
        return Response::make($file, 200, [
                    'Content-Type' => $questionary->mime,
                    'Content-Disposition' => 'inline; filename="' . $questionary->original_filename . '"',
        ]);
    }
    
    public function reviewToTaskOpen($id, $filename) {
        $userId=  Auth::user()->id;
        $studentId=  Students::where('user_id_students',$userId)->pluck('id');
        $review = StudentsReviews::where('id',$id)->where('filename', '=', $filename)->where('student_id_for_review',$studentId)->first();
        $file = Storage::disk('local')->get($review->filename);
        return Response::make($file, 200, [
                    'Content-Type' => $review->mime,
                    'Content-Disposition' => 'inline; filename="' . $review->original_filename . '"',
        ]);
    }

}
