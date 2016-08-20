<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentsReviewsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
//        $student_id = Auth::user()->id;
//        $lecturersReviews = LecturersReviews::where('tutor_id', $tutorId)->get();
//        foreach ($lecturersReviews as $lecturerReview) {
//            $lecturerReview->filename = Fileentry::where('id', $lecturerReview->file_id)->pluck('filename');
//            $lecturerReview->task_name = Tasks::where('id', $lecturerReview->task_id)->pluck('name');
//        }
        return view('studentsReviews.myreviews');
//                ->with('reviews', $reviews);
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
