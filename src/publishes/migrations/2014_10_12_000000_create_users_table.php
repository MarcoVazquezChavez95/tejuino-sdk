<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title', 50);
            $table->string('status', 20)->default('Activo');

            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned()->default(1);
            $table->string('hash', 50)->nullable();
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->timestamp('email_verified_at')->nullable();

            // Status
            $table->string('status', 20)->default('Activo');

            // Personal info
            $table->string('name', 50);
            $table->string('last_name', 50)->default('');
            $table->string('image', 50)->nullable();

            // Registration / recover
            $table->string('registration_mode', 20)->default('email');
            $table->string('recover_code', 4)->nullable();
            $table->datetime('recover_before')->nullable();

            // Social registration
            $table->string('social_id', 20)->nullable();

            // History
            $table->unsignedInteger('created_by_user_id')->nullable();
            $table->unsignedInteger('updated_by_user_id')->nullable();
            $table->unsignedInteger('deleted_by_user_id')->nullable();

            // Timestamps
            $table->rememberToken();
            $table->timestamps();

            // Foreign keys
            $table->foreign('role_id')->references('id')->on('roles');
            $table->foreign('created_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_user_id')->references('id')->on('users')->onDelete('set null');
            $table->foreign('deleted_by_user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
