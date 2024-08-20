<?php

namespace App\Jobs;

use App\Http\Controllers\VPNUtils;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\Queue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\Worker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class CheckCMSBackupsJob implements ShouldQueue
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
        $vpn = new VPNUtils();

        $data = DB::table('nas_passwords')->select('nas', 'password')->get()->all();
        $cms_ips = DB::table('cms_db')->get('Floor_Name')->all();
        $username = "admin";
        $directories = "/volume1/cmsbak"; // Replace with the actual path to directories
        $today = date("Y-m-d");
        $result = [];
        $result['progress'][] = count($data) - 1;
        $result['start '] = date('H:i');

        $nas_count = count($data);
        foreach ($data as $key => $var) {
            $result['progress'] = round(($key / $nas_count) * 100);

            if (!$vpn->isVPNActive()){
                $vpn->startVPN();
            }

            // Connect to SSH server
            $ip = $var->nas;
            $password = $var->password;
            if ($ip == '192.168.10.158')  {
                $vpn->stopVPN();
            }
            $connection = @ssh2_connect($ip);

            if (!$connection) {
                $result[$ip] = "Connection to $ip failed\n";
                $result['stop '] = date('H:i');
                Storage::put('/public/cmsBackups/backup_' . date("d-m-Y"), json_encode($result));
                continue; // Move to the next iteration if connection fails
            }

            // Authenticate with username and password
            if (!ssh2_auth_password($connection, $username, $password)) {
                $result[$ip] = "Authentication on $ip failed";
                ssh2_disconnect($connection);
                continue; // Move to the next iteration if auth fails
            }

            // Execute commands remotely
            $stream = ssh2_exec($connection, "ls -1 $directories");
            socket_set_blocking($stream, true);
            $output = stream_get_contents($stream);
            fclose($stream);

            // Parse directory listing
            $dirs = explode("\n", trim($output));
            //$result[$ip][] = $dirs; debug
            // Loop through each directory
            foreach ($dirs as $dir) {
                if ($dir == "." || $dir == ".." || $dir == '@eaDir' || $dir == 'Task Scheduler logs' || $dir == '#recycle') continue; // Skip current and parent directory
                $dirPath = "$directories/$dir";

                // Check if the directory contains "dirs-daily" and "pgsql-daily" subdirectories
                $dirsDailyPath = "$dirPath/dirs-daily";
                $pgsqlDailyPath = "$dirPath/pgsql-daily";
                if ($this->is_dir_ssh($connection, $dirsDailyPath) && $this->is_dir_ssh($connection, $pgsqlDailyPath)) {
                    // Count files newer than today's date in "dirs-daily" and "pgsql-daily"
                    $dirsFilesCount = $this->countFilesNewerThan($connection, $dirsDailyPath, $today);
                    $pgsqlFilesCount = $this->countFilesNewerThan($connection, $pgsqlDailyPath, $today);

                    // Output message if file counts are below threshold
                    if ($dirsFilesCount < 6) {
                        $result[$ip][] = "$dir dirs missing $ip $dirsFilesCount\n";
                    }
                    if ($pgsqlFilesCount < 7) {
                        $result[$ip][] =  "$dir pgsql missing $ip $pgsqlFilesCount\n";
                    }
                }
            }
            $result['stop '] = date('H:i');
            Storage::put('/public/cmsBackups/backup_' . date("d-m-Y"), json_encode($result));
            // Close the SSH connection
            ssh2_disconnect($connection);
        }
        $vpn->stopVPN();
    }
    function is_dir_ssh($connection, $dir): bool
    {
        // Check if a directory exists remotely
        $stream = ssh2_exec($connection, "test -d $dir && echo 1 || echo 0");
        socket_set_blocking($stream, true);
        $output = stream_get_contents($stream);
        fclose($stream);
        return trim($output) == "1";
    }

    function countFilesNewerThan($connection, $dir, $date): int
    {
        // Count files newer than a given date in a directory remotely
        $stream = ssh2_exec($connection, "find $dir -maxdepth 1 -type f -newermt \"$date\" | wc -l");
        socket_set_blocking($stream, true);
        $output = stream_get_contents($stream);
        fclose($stream);
        return intval(trim($output));
    }
}
