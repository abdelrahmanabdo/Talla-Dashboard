<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Stylist;
use App\Models\StylistBankAccount;

class StylistBankAccountFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = StylistBankAccount::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'stylist_id' => Stylist::factory(),
            'name_on_card' => $this->faker->word,
            'card_number' => $this->faker->word,
            'expire_date' => $this->faker->word,
            'CVV' => $this->faker->numberBetween(-10000, 10000),
        ];
    }
}
