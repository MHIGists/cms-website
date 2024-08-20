<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FLSController extends Controller
{
    public function index()
    {
        return view('fls_schedule_submit');
    }
    public function result()
    {
        return view('fls_schedule_result');
    }
}
