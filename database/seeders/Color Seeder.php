<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class Color Seeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Color::factory()->count(5)->create();
    }
}
