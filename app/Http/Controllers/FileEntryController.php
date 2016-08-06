<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Storage;
use File;
use App\Fileentry;
use DB;
use Response;

class FileEntryController extends Controller {

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
        $entries = DB::table('fileentries')->get();
        return view('fileentries.index', compact('entries'));
    }

    public function add(Request $request) {
        $file = $request->all();
        $extension = $file['filefield']->getClientOriginalExtension();
        $r = Storage::disk('local')->put($file['filefield']->getFilename() . '.' . $extension, File::get($file['filefield']));
        $entry = new Fileentry();
        $entry->mime = $file['filefield']->getClientMimeType();
        $entry->original_filename = $file['filefield']->getClientOriginalName();
        $entry->filename = $file['filefield']->getFilename() . '.' . $extension;
        $entry->save();
        return redirect('fileentry');
    }

    public function get($filename) {

        $entry = Fileentry::where('filename', '=', $filename)->firstOrFail();
        $file = Storage::disk('local')->get($entry->filename);
        return $file;
    }

}
