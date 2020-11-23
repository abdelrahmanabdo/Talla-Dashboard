<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Stylist;
use App\Models\StylistProject;

class StylistProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StylistProject::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stylist_id' => Stylist::factory(),
            'name' => $this->faker->name,
            'description' => $this->faker->text,
        ];
    }
}
