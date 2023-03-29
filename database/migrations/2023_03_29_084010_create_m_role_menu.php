<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMRoleMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_role_menu', function (Blueprint $table) {
            $table->id();
            $table->integer('id_role');
            $table->integer('id_menu');
            $table->string('alias_menu')->nullable();
            $table->boolean('c_select')->default('t');
            $table->boolean('c_insert')->default('t');
            $table->boolean('c_update')->default('t');
            $table->boolean('c_delete')->default('t');
            $table->boolean('c_import')->default('t');
            $table->boolean('c_export')->default('t');
            $table->integer('urutan')->nullable();
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
        Schema::dropIfExists('m_role_menu');
    }
}
