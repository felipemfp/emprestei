<?php

namespace App\Http\Controllers;

class MainController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function index()
    {
        return view('index');
    }
    
    public function post()
    {
        return redirect(route('main.index'));
    }
}
