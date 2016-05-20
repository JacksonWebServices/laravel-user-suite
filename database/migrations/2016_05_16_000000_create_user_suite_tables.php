<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateUserSuiteTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(config('usersuite.db') . '.' . 'roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->timestamps();
        });

        Schema::create(config('usersuite.db') . '.' . 'role_user', function (Blueprint $table) {
            $table->integer('role_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->boolean('is_primary')->default(false);
            $table->foreign('role_id')
                ->references('id')
                ->on('roles')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->primary(['role_id', 'user_id']);
        });

        Schema::create(config('usersuite.db') . '.' . 'permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->boolean('is_protected')->default(true);
            $table->timestamps();
        });

        Schema::create(config('usersuite.db') . '.' . 'permission_role', function (Blueprint $table) {
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
        
        Schema::create(config('usersuite.db') . '.' . 'attributes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label')->nullable();
            $table->boolean('is_unique')->default(true);
            $table->timestamps();
        });

        Schema::create(config('usersuite.db') . '.' . 'attribute_user', function (Blueprint $table) {
            $table->integer('attribute_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('data')->default(1);
            $table->foreign('attribute_id')
                ->references('id')
                ->on('attributes')
                ->onDelete('cascade');
            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
            $table->primary(['attribute_id', 'user_id', 'data']);
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
        Schema::drop('role_user');
        Schema::drop('permissions');
        Schema::drop('permission_role');
        Schema::drop('attributes');
        Schema::drop('attribute_user');
    }
}
