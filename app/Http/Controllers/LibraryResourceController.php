<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LibraryResourceController extends Controller
{
    public function index() {
        return view('backEnd.libraryResource.index');
    }
}
