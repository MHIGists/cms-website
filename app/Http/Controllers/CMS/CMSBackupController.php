<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Jobs\CheckCMSBackupsJob;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CMSBackupController extends Controller
{
    public function showContent()
    {
        return view('cmsBackup'); // Empty content for non-existent file
    }
    public function progress()
    {

        //todo pull host passwords and match with nas password

        $filename = 'backup_' . date('d-m-Y');
        $filePath = '/public/cmsBackups/'. $filename;
        $dailyBackup = Storage::exists($filePath);
        if (Storage::exists($filePath)) {
            $fileContents = Storage::json($filePath);
            return view('cmsBackupProgress', compact('fileContents', 'dailyBackup'));
        }
        return view('cmsBackupProgress', compact('filePath', 'dailyBackup'));
    }
    public function startBackup()
    {
        CheckCMSBackupsJob::dispatch();
        return redirect(route('cmsBackups.showContent'));
    }
}
