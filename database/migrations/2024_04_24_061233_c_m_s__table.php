<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('CMS_Table', function (Blueprint $table) {
            $table->id();
            $table->string('Casino')->nullable();
            $table->string('Host_Password')->nullable();
            $table->string('Zabbix_Password')->nullable();
            $table->ipAddress('HOST_1_2')->nullable();
            $table->ipAddress('Router')->nullable();
            $table->ipAddress('NAS')->nullable();
            $table->ipAddress('IRMC')->nullable();
            $table->string('pfsense_password')->nullable();
            $table->string('floor_name')->nullable();
            $table->ipAddress('cms_ip')->nullable();
            $table->text('LastUpdateUser')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
    }
};
