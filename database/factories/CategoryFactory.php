<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Category;

class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Category::class;

    public function definition()
    {
        return [
            'title' => $this->faker->unique()->word,
            'description' => $this->faker->paragraph,
            'status' => $this->faker->unique()->randomElement([0, 1]),
            'position' => $this->faker->numberBetween(1, 100),
            'slug' => $this->faker->slug,
        ];
    }
}
