<?php

namespace App\Http\Controllers\Admin;

use App\Expansion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpansionController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $expansions = Expansion::all();
        return view('admin.expansion.index', compact('expansions'));
    }

    public function details($id){
        $expansion = Expansion::find($id);

        return view('admin.expansion.details', compact('expansion'));
    }
}
