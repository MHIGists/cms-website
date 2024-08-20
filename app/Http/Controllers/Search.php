<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use Illuminate\Support\Facades\DB;

class Search extends Controller
{
    
    public function search(Request $request){
        
        $input = $request->input('query');
        $id = DB::table('cms_db')
        ->select('id')
        ->where('NAS', 'like', "%$input%")
        ->orWhere('Casino', 'like', "%$input%")
        ->orWhere('Host_Password', 'like', "%$input%")
        ->orWhere('HOST_1_2', 'like', "%$input%")
        ->orWhere('Zabbix_Password', 'like', "%$input%")
        ->orWhere('Router', 'like', "%$input%")
        ->orWhere('CMS_IP', 'like', "%$input%")
        ->orWhere('Floor_Name', 'like', "%$input%")
        ->get();        
        if (empty($id[0])) {
            return redirect()->back()->with('error', 'No results found');
        }
       

        
        $id = $id[0]->id;
        return redirect()->route('get.installation.info', ['id' => $id]);
    }


}
