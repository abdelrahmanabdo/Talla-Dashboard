<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Closet;
use App\Models\Color;
use App\Models\User;

class ClosetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Closet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'type' => $this->faker->numberBetween(-10000, 10000),
            'season' => $this->faker->numberBetween(-10000, 10000),
            'category_id' => Category::factory(),
            'color_id' => Color::factory(),
            'brand_id' => Brand::factory(),
            'price' => $this->faker->word,
            'comment' => $this->faker->text,
            'image' => $this->faker->word,
        ];
    }
}
