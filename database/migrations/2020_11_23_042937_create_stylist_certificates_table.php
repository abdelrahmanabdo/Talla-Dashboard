<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('stylist_certificates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stylist_id')->constrained()->cascadeOnDelete();
            $table->string('certificate_name', 150);
            $table->string('organization_name', 150)->nullable();
            $table->integer('issurance_years');
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
        Schema::dropIfExists('stylist_certificates');
    }
}
