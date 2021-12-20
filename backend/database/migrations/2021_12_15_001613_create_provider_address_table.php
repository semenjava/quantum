<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_address', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('provider_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('providers')
                ->onDelete("cascade");
            $table->bigInteger('address_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('addresses')
                ->onDelete("cascade");
            $table->timestamps();

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
                ->onDelete('cascade');

            $table->foreign('address_id')
                ->references('id')
                ->on('addresses')
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
        Schema::dropIfExists('provider_address');
    }
}
