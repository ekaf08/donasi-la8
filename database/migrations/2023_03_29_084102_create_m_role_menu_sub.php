<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMRoleMenuSub extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('m_role_menu_sub', function (Blueprint $table) {
            $table->id();
            $table->integer('id_role_menu');
            $table->integer('id_sub_menu');
            $table->string('alias_sub_menu')->nullable();
            $table->boolean('c_select')->default('f');
            $table->boolean('c_insert')->default('f');
            $table->boolean('c_update')->default('f');
            $table->boolean('c_delete')->default('f');
            $table->boolean('c_import')->default('f');
            $table->boolean('c_export')->default('f');
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
        Schema::dropIfExists('m_role_menu_sub');
    }
}
