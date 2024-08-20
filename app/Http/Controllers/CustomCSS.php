<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Schema;

class CustomCSS extends Controller
{
    public function saveColorChoices(Request $request)
    {
        
        $user = Auth::user();
        $user->background_color = $request->input('background_color');
        $user->navlink_color = $request->input('navlink_color');
        $user->save();
        
        return redirect()->back()->with('success', 'Color choices saved successfully.');
    }
}
