<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Blog;
use App\Models\User;

class BlogFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Blog::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'title' => $this->faker->sentence(4),
            'body' => $this->faker->text,
            'likes' => $this->faker->numberBetween(-10000, 10000),
            'is_reviewed' => $this->faker->boolean,
            'active' => $this->faker->boolean,
            'published_at' => $this->faker->dateTime(),
            'softDeletes' => $this->faker->word,
        ];
    }
}
