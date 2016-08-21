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
        }
        return view('studentsReviews.myreviews')->with('reviews', $reviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function openQuestionary($id, $filename) {
        $questionary=Fileentry::where('id', $id)->where('filename', '=', $filename)->first();
        $file = Storage::disk('local')->get($questionary->filename);
        return Response::make($file, 200, [
                    'Content-Type' => $questionary->mime,
                    'Content-Disposition' => 'inline; filename="' . $questionary->original_filename . '"',
        ]);
    }
    
    public function openSolutionToReview($id, $filename){
        $taskSolution=  TasksSolutions::where('id', $id)->where('filename', '=', $filename)->first();
        $file = Storage::disk('local')->get($taskSolution->filename);
        return Response::make($file, 200, [
                    'Content-Type' => $taskSolution->mime,
                    'Content-Disposition' => 'inline; filename="' . $taskSolution->original_filename . '"',
        ]);
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
