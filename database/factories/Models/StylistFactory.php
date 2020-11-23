<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Country;
use App\Models\Stylist;
use App\Models\User;

class StylistFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Stylist::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'avatar' => $this->faker->word,
            'email' => $this->faker->safeEmail,
            'country_id' => Country::factory(),
            'bio' => $this->faker->text,
            'experience_years' => $this->faker->numberBetween(-10000, 10000),
            'is_approved' => $this->faker->boolean,
            'active' => $this->faker->boolean,
            'softDeletes' => $this->faker->word,
        ];
    }
}
