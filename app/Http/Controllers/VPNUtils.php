<?php

namespace App\Http\Controllers;

class VPNUtils
{
    public function __construct()
    {
        ini_set('default_socket_timeout', 5);
        $this->startVPN();
    }
    public function awaitVPN(): bool
    {
        $output = shell_exec('sudo systemctl is-active openvpn');
        if ($output == null){
            return false;
        }
        while ($output == 'active'){
            sleep(1);
            $output = shell_exec('sudo systemctl is-active openvpn');
        }
        return true;
    }
    public function startVPN(): true|\Illuminate\Http\RedirectResponse
    {
        if ($this->awaitVPN()){
            //todo
            exec("sudo systemctl start openvpn");
            sleep(1);
            return true;
        }else{
            return redirect()->back()->with('error', 'Error. Try again later.');
        }
    }
    public function stopVPN(): true
    {
        exec("sudo systemctl stop openvpn");
        sleep(1);
        return true;
    }
    public function  isVPNActive()
    {
        if(shell_exec('sudo systemctl is-active openvpn') == 'active'){
            return true;
        }
        return false;
    }
}
