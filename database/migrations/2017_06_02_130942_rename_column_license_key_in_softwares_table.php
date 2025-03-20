<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnLicenseKeyInSoftwaresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('softwares', function (Blueprint $table) {
            $table->renameColumn('licenseKey', 'license_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('softwares', function (Blueprint $table) {
            $table->renameColumn('license_id', 'licenseKey');
        });
    }
}
