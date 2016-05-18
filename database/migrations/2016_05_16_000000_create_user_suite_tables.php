<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserSuiteTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->integer('level')->default(0);
            $table->timestamps();
        });
        
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });
        
        Schema::create('permission_role', function (Blueprint $table) {
            $table->integer('permission_id')->unsigned();
            $table->integer('role_id')->unsigned();
            $table->foreign('permission_id')
                ->references('id')
                ->on('permissions')
                ->onDelete('cascade');
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
            $table->primary(['permission_id', 'role_id']);
        });

        Schema::create('attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });
        
        Schema::create('attribute_user', function (Blueprint $table) {
            $table->integer('attribute_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('data');
            $table->foreign('attribute_id')
                ->references('id')
                ->on('attributes')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->primary(['attribute_id', 'user_id']);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->integer('role_id')->unsigned()->nullable();
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('set null');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('roles');
        Schema::drop('permissions');
        Schema::drop('permission_role');
        Schema::drop('attributes');
        Schema::drop('attribute_user');

        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']);
            $table->dropColumn('role_id');
        });
    }
}