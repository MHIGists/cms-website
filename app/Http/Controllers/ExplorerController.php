<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;

class ExplorerController extends Controller
{
    private string $directory = "public/";

    public function index()
    {
        $directories = Storage::directories($this->directory);
        $directory = $this->directory;
        return view('explorer', compact('directories', 'directory'));
    }
    public function explorePath(string $path)
    {
        $directory = $path; //quick fix TODO
        $directories = Storage::directories($path);
        $files = Storage::files($path);
        return view('explorer', compact('files', 'directory', 'directories'));
    }
    public function download(string $path)
    {
        $file = 'app/' . urldecode($path);
        $filePath = storage_path($file);
        return response()->download($filePath);
    }
}
