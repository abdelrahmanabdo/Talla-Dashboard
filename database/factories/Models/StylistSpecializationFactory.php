<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Specialization;
use App\Models\Stylist;
use App\Models\StylistSpecialization;

class StylistSpecializationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StylistSpecialization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stylist_id' => Stylist::factory(),
            'specialization_id' => Specialization::factory(),
            'description' => $this->faker->text,
            'start_price' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
