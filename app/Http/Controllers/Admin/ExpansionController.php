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
        $expansions = Expansion::orderBy('id', 'desc')->get();

        return view('admin.expansion.index', compact('expansions'));
    }

    public function details($id){
        $expansion = Expansion::find($id);

        return view('admin.expansion.details', compact('expansion'));
    }

    public function saveIconAbbr(Request $request){
        $id = base64_decode($request->id);

        $expansion = Expansion::find($id);

        if($expansion === null){
            die;
        }

        $expansion->icon_abbr = $request->value;
        $expansion->save();

        return 'succes';
    }
}
