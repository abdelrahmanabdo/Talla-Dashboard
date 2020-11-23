<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStylistBankAccountsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();

        Schema::create('stylist_bank_accounts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('stylist_id')->constrained()->cascadeOnDelete();
            $table->string('name_on_card', 150);
            $table->string('card_number', 17);
            $table->string('expire_date', 10);
            $table->integer('CVV');
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
        Schema::dropIfExists('stylist_bank_accounts');
    }
}
