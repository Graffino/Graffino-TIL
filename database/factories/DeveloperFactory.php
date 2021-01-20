<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class DeveloperFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Developer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'email' => $this->faker->unique->safeEmail(),
            'username' => $this->faker->userName(),
            'twitter_handle' => $this->faker->domainName(),
            'admin' => $this->faker->boolean($chanceOfGettingTrue = 50),
            'editor' => 'Text Field',
        ];
    }
}
