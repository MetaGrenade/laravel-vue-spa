<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('description')->nullable()->default(null);
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('icon')->nullable()->default(null);
            $table->string('color')->nullable()->default(null);
            $table->string('description')->nullable()->default(null);
            $table->integer('access_level')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });

        // Schema::create('role_has_permissions', function (Blueprint $table) {
        //     $table->engine = 'InnoDB';
        //     $table->integer('permission_id')->unsigned();
        //     $table->integer('role_id')->unsigned();
        //     $table->timestamps();
            
        //     $table->foreign('permission_id')
        //         ->references('id')
        //         ->on('permissions')
        //         ->onDelete('cascade');

        //     $table->foreign('role_id')
        //         ->references('id')
        //         ->on('roles')
        //         ->onDelete('cascade');

        //     $table->primary(['permission_id', 'role_id']);
        // });

        // Schema::create('user_has_role', function (Blueprint $table) {
        //     $table->engine = 'InnoDB';
        //     $table->integer('user_id')->unsigned();
        //     $table->integer('role_id')->unsigned();
        //     $table->timestamps();
            
        //     $table->foreign('user_id')
        //         ->references('id')
        //         ->on('users')
        //         ->onDelete('cascade');

        //     $table->foreign('role_id')
        //         ->references('id')
        //         ->on('roles')
        //         ->onDelete('cascade');

        //     $table->primary(['user_id', 'role_id']);
        // });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::dropIfExists('user_has_role');
        // Schema::dropIfExists('role_has_permissions');
        Schema::dropIfExists('roles');
        Schema::dropIfExists('permissions');
    }
}
