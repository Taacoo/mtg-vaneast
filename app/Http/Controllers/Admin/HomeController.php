<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        return view('admin.index');
    }
}
