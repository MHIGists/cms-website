<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Http\Controllers\VPNUtils;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PingController extends Controller
{
    public function index(Request $request)
    {
        $ip = $request->ip;
        $vpn = new VPNUtils();

        // Validate the IP address
        $validator = Validator::make(['ip' => $ip], [
            'ip' => 'required|ip',
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            $vpn->stopVPN();
            // Handle validation failure, return response or redirect
            return back()->with('error', 'Requested IP is empty or wrong');
        }

        $result = exec("ping $ip -c 1");
        $vpn->stopVPN();
        if ($result == ""){
            return back()->with('no-ping', 'No ping');
        }else{
            return back()->with('ping', 'Host is online: ' . $result);
        }
    }
}
