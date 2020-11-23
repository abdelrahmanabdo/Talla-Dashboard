<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('user_profiles', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->string('avatar', 150);
            $table->string('mobile', 15);
            $table->string('birth_date', 20);
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('body_shaped_id');
            $table->unsignedBigInteger('skin_glow_id');
            $table->unsignedBigInteger('job_id');
            $table->unsignedBigInteger('goal_id');
            $table->unsignedBigInteger('favourite_style_id');
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
        Schema::dropIfExists('user_profiles');
    }
}
