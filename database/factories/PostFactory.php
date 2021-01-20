<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \App\Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $title = $this->faker->name();
        return [
            'title' => $title,
            'body' => $this->faker->text(),
            'slug' => App\Post::saltSlug(App\Post::slugifyTitle($this->title)),
            'developer_id' => $this->faker->randomElement([1,2]),
            'channel_id' => $this->faker->randomElement([1,2]),
        ];
    }
}
