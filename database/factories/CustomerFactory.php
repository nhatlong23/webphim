<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Customer;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */

    protected $model = Customer::class;
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'google_id' => $this->faker->unique()->randomElement([0, 1]),
            'facebook_id' => $this->faker->unique()->randomElement([0, 1]),
            'password' => $this->faker->password,
            'token' => $this->faker->password,
            'verification_code' => $this->faker->password,
            'emailed_movies' => $this->faker->password,
            'verified' => $this->faker->numberBetween(0, 1),
            'locked' => $this->faker->numberBetween(0, 1),
            'email_verified_at' => $this->faker->dateTime(),
            'expires_at' => $this->faker->dateTime(),
            'remember_token' => $this->faker->password,
        ];
    }
}
