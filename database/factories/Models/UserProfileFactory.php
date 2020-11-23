<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\RegistrationChoices;
use App\Models\User;
use App\Models\UserProfile;

class UserProfileFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = UserProfile::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'body_shaped_id' => RegistrationChoices::factory(),
            'skin_glow_id' => RegistrationChoices::factory(),
            'job_id' => RegistrationChoices::factory(),
            'goal_id' => RegistrationChoices::factory(),
            'favourite_style_id' => RegistrationChoices::factory(),
        ];
    }
}
