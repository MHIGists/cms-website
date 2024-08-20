<?php
namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CreateBackup extends Controller
{
    public function CreateBackup($floorName){

        $ip = DB::select('select CMS_IP from cms_db where Floor_Name = ?', [$floorName]);
        if( empty($ip) ){
            echo "$floorName doesn't exist";
        }
        else{
        $ip = $ip[0]->CMS_IP;

        $connection = new CMSConnection($ip[0]);
        if ($connection->isConnected()){
        $con = $connection->getConnection();
        $connection->sendLoginReason('Create Backup');

        $command = ssh2_exec($con, 'sudo "hello"');
        sleep(1);
        fwrite($connection->getShell(), "y\n");
        socket_set_blocking($con, true);

        $output = stream_get_contents($command);
        $connection->closeSSHConnection();
        //todo long task needs to be async
        Storage::put('/public/cmsBackups/' . $floorName . date("d-m-Y"), $output);
    }
        return redirect()->back();
        }
    }
}
