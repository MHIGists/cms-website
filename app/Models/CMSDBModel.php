<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CMSDBModel extends Model
{
    //TODO not used anywhere currently
    use HasFactory;
    protected $table = "CMS_DB";
    protected $fillable = ['Casino', 'Host_Password', 'Zabbix_Password', 'Host_1_2', ' Router', 'NAS', 'CMS_IP', 'Floor_Name'];
}
