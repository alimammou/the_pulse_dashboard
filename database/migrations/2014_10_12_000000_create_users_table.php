<?php

use App\Enums\UserStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->timestamp('approved_at')->nullable();
            $table->rememberToken();

            $table->string('profile_photo_path', 2048)->nullable();
            $table->timestamps();

            $table->string('status')->default(UserStatus::Active);

            $table->foreignId('created_by')->nullable();
            $table->foreignId('updated_by')->nullable();

            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
