<?php

namespace App\Jobs;

use App\Http\Controllers\VPNUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class PullPFSenseBackups implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {

    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $this->saveProgress('');

        $vpn = new VPNUtils();

        $routers = DB::table('cms_db')->select('Router')->get()->all();
        $username = 'username';
        $password = 'password';
        $remote_dir = '/conf/backup';
        $router_count = count($routers) - 1;

        foreach ($routers as $key => $router) {
            $ip = $router->Router;
            // SSH Connection
            $connection = @ssh2_connect($ip);
            if (!$connection) {
                // Unable to connect via SSH
                $this->saveProgress($key / $router_count);
                continue; // Move to next router
            }
            // SSH Authentication
            if (!@ssh2_auth_password($connection, $username, $password)) {
                // Authentication failed
                ssh2_disconnect($connection);
                $this->saveProgress($key / $router_count);
                continue; // Move to next router
            }
            sleep(1);//wait because of that sftp piece of shit
            $sftp = @ssh2_sftp($connection);

            if (!$sftp){
                ssh2_disconnect($connection);
                $this->saveProgress($key / $router_count);
                continue;
            }

            $int_sftp = intval($sftp);
            $sftp_dir = 'ssh2.sftp://' .  $int_sftp. '/.' . $remote_dir;

            $dir_handle = opendir($sftp_dir);
            $remote_files = [];
            $file = readdir($dir_handle);
            while ($file != false) {
                if ($file != '.' && $file != '..') {
                    $remote_files[] = '/.' . $remote_dir . '/' . $file;
                }
                $file = readdir($dir_handle);
            }
            closedir($dir_handle);

            foreach ($remote_files as $remote_file) {
                if (!$remoteStream = @fopen("ssh2.sftp://$int_sftp$remote_file", 'r')) {
                    continue;
                }

//                $filesize = filesize("ssh2.sftp://$int_sftp$remote_file");
                if (!Storage::exists('public/pfsenseBackups/' . $ip)) {
                    Storage::disk('local')->makeDirectory('public/pfsenseBackups/' . $ip);
                    Storage::disk('local')->makeDirectory('public/pfsenseBackups/' . $ip . '/auto_backups');
                }
                $file_array = explode('/', $remote_file);
                Storage::put('public/pfsenseBackups/' . $ip . '/auto_backups/' . end($file_array), fread($remoteStream,50000000));
                fclose($remoteStream);
            }
            ssh2_disconnect($connection);
            $this->saveProgress($key / $router_count);
        }
        $vpn->stopVPN();
    }
    public function saveProgress($data){
        $pfsenseBackupsPath = '/public/pfsense_backups';
        Storage::put($pfsenseBackupsPath, $data);
    }
}
