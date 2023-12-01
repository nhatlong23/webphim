<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infos', function (Blueprint $table) {
            $table->id();
            $table->string('title', 100)->unique();
            $table->longText('description')->unique();
            $table->string('logo')->unique();
            $table->longText('terms_of_use')->unique();
            $table->longText('contact')->unique();
            $table->longText('privacy_policy')->unique();
            $table->longText('copyright_claims')->unique();
            $table->longText('about_us')->unique();
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
        Schema::dropIfExists('infos');
    }
}
