<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index(){

        return view('content.search.index');
    }

    public function search(){

    }
}
