<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Console\View\Components\Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class NewInstallationController extends Controller
{
    public function index(){
        return view('add_new_installation');
    }
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'installation_name' => 'required|string|max:255',
            'installation_password' => 'required|string|max:255',
            'zabbix_password' => 'required|string|max:255',
            'installation_ip' => 'required|ip',
            'router_ip' => 'required|ip',
            'nas_ip' => 'required|ip',
            'CMS_IP'=> 'required|ip',
            'Floor_Name'=>'required|string|max:255',
            'certificates' => 'max:10240', // Max 10MB TODO doesn't work when "required"
            'pfsense_config' => 'max:10240', // Max 10MB TODO doesn't work when "required"
        ]);
        // Store the form data in the database

        $name = $validatedData['installation_name'];
        $password = $validatedData['installation_password'];
        $zabbix_password = $validatedData['zabbix_password'];
        $installation_ip = $validatedData['installation_ip'];
        $router_ip = $validatedData['router_ip'];
        $nas_ip = $validatedData['nas_ip'];
        $CMS_IP = $validatedData['CMS_IP'];
        $Floor_Name = $validatedData['Floor_Name'];

        if ($request->hasFile('certificates')) {
            $request->file('certificates')->store('public/vpnCertificates/'.$Floor_Name);
        }

        if ($request->hasFile('pfsense_config')) {
            $request->file('pfsense_config')->store('public/pfsenseBackups/backups/'. $router_ip);
        }
        DB::insert('insert into CMS_Table (Casino, Host_Password, Zabbix_Password, HOST_1_2, Router, NAS, cms_ip, floor_name) values (?, ?, ?, ?, ?, ? , ?, ?)', [$name,$password,$zabbix_password,$installation_ip,$router_ip,$nas_ip,$CMS_IP,$Floor_Name ]);
        $id = DB::getPdo()->lastInsertId();
//        $result = DB::select('select count(*) as count from nas_passwords where nas = ?', [$nas_ip]);
//        if ($result[0]->count == 0) {
//        DB::insert('insert into nas_passwords (nas, password) values (?, ?)', [$nas_ip,$password]);
//        }
//        return redirect()->route('get.installation.info', ['id' => $id])->with('success', 'Installation created successfully!');
        return redirect()->route('get.table');
    }
}
