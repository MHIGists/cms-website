<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class TableController extends Controller
{
    public function index()
    {
        $table = DB::table('CMS_Table')->get()->all();
        $preferences = ['Casino', 'Host Password', 'Zabbix Password', 'Host 1/2', 'Router IP', 'NAS IP', 'CMS IP', 'CMS Floor Name', 'SSH'];
        return view('table_index', compact('table', 'preferences'));
    }
}
