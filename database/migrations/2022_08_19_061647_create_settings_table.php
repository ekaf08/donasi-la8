<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('owner_name');
            $table->string('email')->unique();
            $table->string('phone');
            $table->string('company_name');
            $table->text('short_description')->nullable();
            $table->string('keyword');
            $table->text('about')->nullable();
            $table->text('address')->nullable();
            $table->char('postal_code', 5);
            $table->string('city')->nullable();
            $table->string('province')->nullable();
            $table->string('path_image')->nullable();
            $table->string('path_image_header')->nullable();
            $table->string('path_image_footer')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('settings');
    }
}
