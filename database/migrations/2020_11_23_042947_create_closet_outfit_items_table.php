<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClosetOutfitItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('closet_outfit_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('outfit_id')->constrained('Outfits')->cascadeOnDelete();
            $table->foreignId('closet_item_id')->constrained('Closets')->cascadeOnDelete();
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('closet_outfit_items');
    }
}
