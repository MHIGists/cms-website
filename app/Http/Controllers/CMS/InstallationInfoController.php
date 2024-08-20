<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class InstallationInfoController extends Controller
{
    public function index($id)
    {
        $installation = DB::table('CMS_Table')->where('id', $id)->get();
        $installation = $installation[0];
        $pfsense_backup = explode('.', $installation->cms_ip);
        $pfsense_backup[3] = 201;
        $pfsense_backup = implode('.', $pfsense_backup);
        return view('installation_info', compact('installation', 'pfsense_backup'));
    }
    public function update(Request $request)
    {
        $id = $request->input('id');
        $LastUser =  Auth::user()->name ;
        // Update the database record
        $record = DB::table('CMS_Table')->select('Host_Password', 'NAS')->where('id', $id)->get();

        DB::table('CMS_Table')
            ->where('id', $id)
            ->update([
                'Casino' => $request->input('casino'),
                'Host_Password' => $request->input('host_password'),
                'Zabbix_Password' => $request->input('zabbix_password'),
                'HOST_1_2' => $request->input('host_1_2'),
                'Router' => $request->input('router'),
                'NAS' => $request->input('nas'),
                'cms_ip' => $request->input('cms_ip'),
                'floor_name' => $request->input('floor_name'),
                'notes' => $request->input('notes'),
                'LastUpdateUser' => ($LastUser)
            ]);

        // Redirect back to the form with a success message
        return redirect()->back()->with('success', 'Information updated successfully');
    }
    public function delete($id)
    {
        // Update the database record
        DB::table('CMS_Table')
            ->where('id', $id)
            ->delete();
        //dd($id);
        // Redirect back to the form with a success message
        return redirect(route('get.table'))->with('success', 'Installation deleted successfully');
    }

}
