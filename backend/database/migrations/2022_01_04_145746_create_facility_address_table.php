<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityAddressTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_address', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('facility_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('facilities')
                ->onDelete("cascade");
            $table->bigInteger('address_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('addresses')
                ->onDelete("cascade");
            $table->timestamps();

            $table->foreign('facility_id')
                ->references('id')
                ->on('facilities')
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
        Schema::dropIfExists('facility_address');
    }
}
