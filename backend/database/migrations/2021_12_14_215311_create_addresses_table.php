<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->id();
            $table->string('address_line_1');
            $table->string('address_line_2')->nullable();
            $table->integer('country_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('countries')
                ->onDelete("cascade");
            $table->integer('city_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('cities')
                ->onDelete("cascade");
            $table->timestamps();
            $table->string('postal')->nullable();
            $table->boolean('primary_address')->default(false);
            $table->boolean('billing_address')->default(false);

            $table->foreign('country_id')
                ->references('id')
                ->on('countries')
                ->onDelete('cascade');

            $table->foreign('city_id')
                ->references('id')
                ->on('cities')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('addresses');
    }
}
