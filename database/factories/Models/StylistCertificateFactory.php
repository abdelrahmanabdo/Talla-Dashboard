<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Stylist;
use App\Models\StylistCertificate;

class StylistCertificateFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StylistCertificate::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stylist_id' => Stylist::factory(),
            'certificate_name' => $this->faker->word,
            'organization_name' => $this->faker->word,
            'issurance_year' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
