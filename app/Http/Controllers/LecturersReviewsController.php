<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Tasks;
use Auth;
use App\Students;
use Carbon\Carbon;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\LecturersReviews;
use App\Fileentry;
use Illuminate\Support\Facades\Redirect;
use Input;
use App\Lecturer;

class LecturersReviewsController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        $tutorId = Auth::user()->id;
        $lecturerId = Lecturer::where('user_id_lecturer', $tutorId)->pluck('id');
        $lecturersReviews = LecturersReviews::where('tutor_id', $lecturerId)->get();
        foreach ($lecturersReviews as $lecturerReview) {
            $lecturerReview->filename = Fileentry::where('id', $lecturerReview->file_id)->pluck('filename');
            $lecturerReview->task_name = Tasks::where('id', $lecturerReview->task_id)->pluck('name');
        }
        return view('lecturersReviews.reviews')->with('lecturersReviews', $lecturersReviews);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        $tutorId = Auth::user()->id;
        $lecturerId = Lecturer::where('user_id_lecturer', $tutorId)->pluck('id');
        $tasks = Tasks::where('tutor_id', $lecturerId)->where('active', 1)->get();
        return view('lecturersReviews.create')->with('tasks', $tasks);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store(Request $request) {
        $rules = array(
            'task_id' => 'required|max:100',
            'description' => 'required|max:1000',
            'end_date' => 'required|max:100',
            'questionary' => 'max:50000|mimes:doc,docx,jpeg,png,xlsm,xlsx,jpg,bmp,pdf'
        );
        $validator = \Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('reviews/create')
                            ->withErrors($validator);
        } else {
            return $this->saveReview($request);
        }
    }

    private function saveReview($request) {
        $today = Carbon::today();
        $tutor_id = Auth::user()->id;
        $lecturerId = Lecturer::where('user_id_lecturer', $tutor_id)->pluck('id');
        $endDate = Carbon::parse($request->get('end_date'));
        $fileentry = $request->file('questionary');
        $taskId = $request->get('task_id');
        $task = Tasks::find($taskId);
        $newQuestionaryId = $this->saveFileEntryForLecturer($fileentry, $task);
        $newLecturerReview = new LecturersReviews([
            'tutor_id' => $lecturerId,
            'task_id' => $request->get('task_id'),
            'description' => $request->get('description'),
            'end_date' => $endDate,
            'file_id' => $newQuestionaryId,
            'sent_at' => $today,
        ]);
        $newLecturerReview->save();
        return Redirect::to('reviews');
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
        return $entry->id;
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
        $tutorId = Auth::user()->id;
        $lecturerId = Lecturer::where('user_id_lecturer', $tutorId)->pluck('id');
        $today=  Carbon::today();
        $lecturerReview = LecturersReviews::find($id);  
        $lecturerReview->task_id = Tasks::where('id', $lecturerReview->task_id)->pluck('name');
        $tasks = Tasks::where('tutor_id', $lecturerId)->whereDate('end_date', '>=', $today)->lists('name', 'id');
        return view('lecturersReviews.edit')->with('lecturerReview', $lecturerReview)
                        ->with('tasks', $tasks);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        $rules = array(
            'task_id' => 'required|max:100',
            'description' => 'required|max:1000',
            'end_date' => 'required|max:100',
            'questionary' => 'max:50000|mimes:doc,docx,jpeg,png,xlsm,xlsx,jpg,bmp,pdf'
        );

        $validator = \Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('reviews/' . $id . '/edit')
                            ->withErrors($validator);
        } else {
            return $this->updateReview($id);
        }
    }

    private function updateReview($id) {
        $lecturerReview = LecturersReviews::find($id);
        $lecturerReview->task_id = Input::get('task_id');
        $lecturerReview->description = Input::get('description');
        $endDate = Carbon::parse(Input::get('end_date'));
        $lecturerReview->end_date = $endDate;
        $fileentry = Input::get('questionary');
        if (!empty($fileentry)) {
            $questionary = Fileentry::where('id', $lecturerReview->file_id)->where('tutor_id', $lecturerReview->tutor_id)->first();
            unlink(storage_path('app/' . $questionary->filename));
            $questionary->delete();
            $fileId = $this->saveFileEntryForLecturer($fileentry, $lecturerReview->task_id);
            $lecturerReview->file_id = $fileId;
        }
        $lecturerReview->save();
        return \Redirect::to('reviews');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        $lecturerReview = LecturersReviews::find($id);
        $lecturerId = Lecturer::where('user_id_lecturer', Auth::user()->id)->pluck('id');
        $questionary = Fileentry::where('id', $lecturerReview->file_id)->where('tutor_id', $lecturerId)->first();
        unlink(storage_path('app/' . $questionary->filename));
        $questionary->delete();
        $lecturerReview->delete();
    }

}
