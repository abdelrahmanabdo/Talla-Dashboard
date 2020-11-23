<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistSpecializationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('stylist_specializations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stylist_id')->constrained()->cascadeOnDelete();
            $table->foreignId('specialization_id')->constrained()->cascadeOnDelete();
            $table->string('description', 150);
            $table->integer('start_price')->default(0);
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
        Schema::dropIfExists('stylist_specializations');
    }
}
