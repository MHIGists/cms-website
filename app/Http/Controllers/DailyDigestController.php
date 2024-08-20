<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DailyDigestController extends Controller
{
    public function index()
    {
        return view('daily_digest_submit');
    }
    public function result()
    {
        return view('daily_digest_result');
    }
}
