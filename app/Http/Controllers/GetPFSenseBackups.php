<?php

namespace App\Http\Controllers;

use App\Jobs\PullPFSenseBackups;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Storage;

class GetPFSenseBackups extends Controller
{
    public function index()
    {
        PullPFSenseBackups::dispatch();
        return view('get_pfsense_backups');
    }
    public function progress()
    {
        $path = '/public/pfsense_backups';
        if (Storage::exists($path)){
            return Storage::get($path);
        }
        return '';
    }
}
