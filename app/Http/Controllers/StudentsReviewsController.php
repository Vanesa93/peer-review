<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\QuestionaryToStudent;
use App\Students;
use Auth;
use App\Tasks;
use App\LecturersReviews;
use App\Fileentry;
use App\TasksSolutions;
use Illuminate\Support\Facades\Response;
use Storage;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use App\StudentsReviews;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;

class StudentsReviewsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $userId = Auth::user()->id;
        $studentWriter = Students::where('user_id_students', $userId)->first();
        $reviews = QuestionaryToStudent::where('student_id_writer', $studentWriter->id)->get();
        foreach ($reviews as $reviewTask) {
            $reviewTask->task_name = Tasks::where('id', $reviewTask->task_id)->pluck('name');
            $lecturerReview = LecturersReviews::where('id', $reviewTask->lecturers_review_id)->first();
            $reviewTask->questionary = Fileentry::where('id', $lecturerReview->file_id)->first();
            $reviewTask->review_file = TasksSolutions::where('id', $reviewTask->file_for_review)->first();
            $reviewTask->uploaded_solution = StudentsReviews::where('student_id_writer', $reviewTask->student_id_writer)->where('task_id',$reviewTask->task_id)->first();
        }
        return view('studentsReviews.myreviews')->with('reviews', $reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function openQuestionary($id, $filename) {
        $questionary = Fileentry::where('id', $id)->where('filename', '=', $filename)->first();
        $file = Storage::disk('local')->get($questionary->filename);
        return Response::make($file, 200, [
                    'Content-Type' => $questionary->mime,
                    'Content-Disposition' => 'inline; filename="' . $questionary->original_filename . '"',
        ]);
    }

    public function openSolutionToReview($id, $filename) {
        $taskSolution = TasksSolutions::where('id', $id)->where('filename', '=', $filename)->first();
        $file = Storage::disk('local')->get($taskSolution->filename);
        return Response::make($file, 200, [
                    'Content-Type' => $taskSolution->mime,
                    'Content-Disposition' => 'inline; filename="' . $taskSolution->original_filename . '"',
        ]);
    }
    public function openUploadedReview($id, $filename){
        $studentsReview = StudentsReviews::where('id', $id)->where('filename', '=', $filename)->first();
        $file = Storage::disk('local')->get($studentsReview->filename);
        return Response::make($file, 200, [
                    'Content-Type' => $studentsReview->mime,
                    'Content-Disposition' => 'inline; filename="' . $studentsReview->original_filename . '"',
        ]);
    }

    public function uploadReview($id) {
        $questionary = QuestionaryToStudent::find($id);
        $task = Tasks::find($questionary->task_id);
        return view('studentsReviews.upload')->with('questionary', $questionary)
                        ->with('task', $task);
    }

    public function upload(Request $file, $questinaryId) {
        $rules = array(
            'filefield' => 'max:50000|mimes:doc,docx,jpeg,png,xlsm,xlsx,jpg,jpg,bmp,pdf'
        );

        $validator = \Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            $linkBack = 'myreviews/upload/review/' . $questinaryId;
            return Redirect::to($linkBack)
                            ->withErrors($validator);
        } else {
            $thisQuestionary = QuestionaryToStudent::find($questinaryId);
// student_id_writer student_id_for_review task_id questionary_to_student_id extension	filename mime original_filename	sent_at	
            $fileentry = $file->file('filefield');
            $uploadedSolution = StudentsReviews::where('task_id', $thisQuestionary->task_id)->where('student_id_writer', $thisQuestionary->student_id_writer)->first();
            if (empty($uploadedSolution)) {
                $this->saveSolution($fileentry, $thisQuestionary);
            } else {
                $this->deleteFileFromTask($uploadedSolution->filename, $thisQuestionary);
                $this->saveSolution($fileentry, $thisQuestionary);
            }

            return Redirect::to('myreviews');
        }
    }

    private function saveSolution($file, $thisQuestionary) {
        $extension = $file->getClientOriginalExtension();
        Storage::disk('local')->put($file->getFilename() . '.' . $extension, File::get($file));
        $today = Carbon::today();
        $studentReview = new StudentsReviews();
        $studentReview->mime = $file->getClientMimeType();
        $studentReview->original_filename = $file->getClientOriginalName();
        $studentReview->filename = $file->getFilename() . '.' . $extension;
        $studentReview->student_id_writer = $thisQuestionary->student_id_writer;
        $studentReview->student_id_for_review = $thisQuestionary->student_id_for_review;
        $studentReview->task_id = $thisQuestionary->task_id;
        $studentReview->questionary_to_student_id = $thisQuestionary->id;
        $studentReview->extension = $extension;
        $studentReview->sent_at = $today;
        $studentReview->save();
    }

    private function deleteFileFromTask($filename, $thisQuestionary) {
        StudentsReviews::where('student_id_writer', $thisQuestionary->student_id_writer)->where('filename', $filename)->delete();
        unlink(storage_path('app/' . $filename));
        return "true";
    }

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
