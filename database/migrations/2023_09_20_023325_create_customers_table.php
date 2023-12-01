<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('email', 100)->unique();
            $table->string('google_id', 100);
            $table->string('facebook_id', 100);
            $table->string('password')->unique();
            $table->string('token');
            $table->string('verification_code');
            $table->longText('emailed_movies');
            $table->tinyInteger('verified')->unique();
            $table->tinyInteger('locked')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->timestamp('expires_at')->nullable();
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customers');
    }
}
