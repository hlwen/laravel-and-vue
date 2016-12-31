<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class indexController extends Controller
{
    //
    public function index(Request $request)
    {

        return view('admin.index');
    }
    public function login(Request $request)
    {

        return view('admin.login');
    }
}
