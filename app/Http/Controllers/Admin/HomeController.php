<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Instantiate a new controller instance.
     * 
     * @return void
    */
    public function __construct()
    {
        $this->middleware(['can:admin.home']);
    }

    public function index()
    {
        return view('admin.index');
    }
}
