<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\VPNUtils;
use Illuminate\Http\RedirectResponse;

class CMSConnection
{
    private string $username = 'username';
    private string $password = 'password!';
    private int $port = 22;
    private VPNUtils $vpnCon;
    private $sshConnection;
    private string $ip;
    private $shell;
    public function __construct(string $ip)
    {
        $this->ip = $ip;
        $this->vpnCon = new VPNUtils();
        $this->connect();
        if ($this->isConnected()){
            $this->authenticate();
        }
    }
    public function connect(): CMSConnection
    {
        $this->sshConnection = @ssh2_connect($this->ip, $this->port);
        return $this;
    }
    public function authenticate(): CMSConnection|RedirectResponse
    {
        if (!ssh2_auth_password($this->sshConnection, $this->username, $this->password)){
            $this->closeSSHConnection();
            return back()->with('error', 'Error authenticating to: ' . $this->ip);
        }
        return $this;
    }

    public function getShell(): CMSConnection
    {
        if (!$this->isConnected()){
            return false;
        }
        // Start an interactive shell session
        $shell = ssh2_shell($this->sshConnection, 'vt102', null, 80, 24, SSH2_TERM_UNIT_CHARS);
        sleep(1);
        // Send the required input (e.g., "milko")
        fwrite($shell, "milko\n");
        sleep(1);
        $this->shell = $shell;
        return $this;
    }
    public function closeSSHConnection(): bool
    {
        if (ssh2_disconnect($this->sshConnection)){
            $this->vpnCon->stopVPN();
            return true;
        }
        $this->vpnCon->stopVPN();
        return false;
    }
    public function getConnection()
    {
        return $this->sshConnection;
    }
    public function getVPNConnection(): VPNUtils
    {
        return $this->vpnCon;
    }
    public function isConnected(): CMSConnection|false
    {
        if ($this->sshConnection){
            return $this;
        }
        return false;
    }
    public function sendLoginReason(string $loginReason): CMSConnection|false
    {
        if (!isset($this->shell)){
            $this->getShell();
        }
        if (fwrite($this->shell, $loginReason . "\n")){
            return $this;
        }
        return false;
    }
    public function sendCommand(string $command, int $timeout = 1, bool $confirm = false) :string|false
    {
        $command = ssh2_exec($this->sshConnection, $command);
        sleep($timeout);
        if ($confirm){
            $this->confirmScript($timeout);
        }
        return stream_get_contents($command);
    }
    public function confirmScript(int $timeout = 1): static
    {
        fwrite($this->shell, "y\n");
        sleep($timeout);
        return $this;
    }
}
