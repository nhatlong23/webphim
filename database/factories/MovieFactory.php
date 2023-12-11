<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Movie;

class MovieFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Movie::class;
    public function definition()
    {
        return [
            'title' => $this->faker->word,
            'duration_movie' => $this->faker->numberBetween(1, 100),
            'description' => $this->faker->text,
            'status' => $this->faker->randomElement([0, 1]),
            'image' => $this->faker->imageUrl($width = 640, $height = 480),
            'slug' => $this->faker->slug,
            'category_id' => $this->faker->numberBetween(1, 100),
            'genre_id' => $this->faker->numberBetween(1, 100),
            'country_id' => $this->faker->numberBetween(1, 100),
            'movie_hot' => $this->faker->unique()->numberBetween(0, 1),
            'name_en' => $this->faker->word,
            'resolution' => $this->faker->numberBetween(0, 5),
            'sub_movie' => $this->faker->numberBetween(0, 1),
            'year' => $this->faker->numberBetween(1900, 2026),
            'tags_movie' => $this->faker->word,
            'topview' => $this->faker->numberBetween(1, 100),
            'season' => $this->faker->numberBetween(1, 100),
            'trailer' => $this->faker->word,
            'episodes' => $this->faker->numberBetween(1, 100),
            'thuocphim' => $this->faker->word,
            'director' => $this->faker->word,
            'score_imdb' => $this->faker->numberBetween(1, 100),
            'cast_movie' => $this->faker->word,
            'view_count' => $this->faker->numberBetween(1, 100),
            'emailed' => $this->faker->numberBetween(0, 1),
            'date_created' => $this->faker->date($format = 'Y-m-d', $max = 'now'),
        ];
    }
}
