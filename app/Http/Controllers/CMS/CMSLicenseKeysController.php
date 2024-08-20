<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class CMSLicenseKeysController extends Controller
{
    public function get_specific_license_keys($id): string
    {
        $ip = DB::table('cms_db')->where('id', $id)->value('CMS_IP');

        $connection = new CMSConnection($ip);
        $keys = $connection->sendLoginReason('get license keys')->sendCommand('echo "hello"');
        $connection->closeSSHConnection();

        //$keys; insert those keys into the db
        DB::table('cms_db')
            ->where('id', $id)
            ->update(['license_keys' => $keys]);
        return redirect()->back();
    }
    public function get_all_license_keys()
    {
        //TODO loop trough all installation and get their license keys
    }
}
