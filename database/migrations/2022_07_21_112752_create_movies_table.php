<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('duration_movie', 20);
            $table->longText('description');
            $table->integer('status')->unique();
            $table->string('image');
            $table->integer('category_id');
            $table->integer('genre_id');
            $table->integer('country_id');
            $table->string('slug')->unique();
            $table->integer('movie_hot')->unique();
            $table->string('name_en');
            $table->integer('resolution')->unique();
            $table->integer('sub_movie')->unique();
            $table->string('year', 50)->unique();
            $table->longText('tags_movie');
            $table->integer('topview');
            $table->string('season', 50)->unique();
            $table->string('trailer');
            $table->string('episodes', 50)->unique();
            $table->string('thuocphim', 50)->unique();
            $table->longText('director');
            $table->float('score_imdb');
            $table->longText('cast_movie');
            $table->integer('view_count');
            $table->tinyInteger('emailed');
            $table->string('date_created', 50);
            $table->index(['title', 'name_en']);
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
        Schema::dropIfExists('movies');
    }
}
