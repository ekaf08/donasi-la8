<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColumnsToSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Schema::table('settings', function (Blueprint $table) {
        //     $table->string('owner_name');
        //     $table->string('company_name');
        //     $table->string('short_description');
        //     $table->string('keyword');
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::table('settings', function (Blueprint $table) {
        //     $table->dropColumn([
        //         'owner_name',
        //         'company_name',
        //         'short_description',
        //         'keyword',
        //     ]);
        // });
    }
}
