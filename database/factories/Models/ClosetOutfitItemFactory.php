<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Closet;
use App\Models\ClosetOutfitItem;
use App\Models\Outfit;

class ClosetOutfitItemFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = ClosetOutfitItem::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'outfit_id' => Outfit::factory(),
            'closet_item_id' => Closet::factory()->create()->item_id,
        ];
    }
}
