<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GroupsController extends Controller {

    public function __construct() {
        $this->middleware('auth');
        $this->middleware('notAdmin');
        $this->middleware('language');
    }

    public function create() {
        return view('groups.createGroups');
    }

    public function index() {
        return view('groups.getGroups');
    }

}
