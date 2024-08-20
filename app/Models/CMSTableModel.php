<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMSTableModel extends Model
{
    use HasFactory;
    protected $table = 'CMS_Table';
    protected $fillable = ['Casino', 'Host_Password', 'Zabbix_Password', 'HOST_1_2', 'Router', 'NAS', 'IRMC', 'pfsense_password', 'floor_name', 'cms_ip'];
}
