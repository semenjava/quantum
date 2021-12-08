<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilityProviderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_provider', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('facility_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('facilities')
                ->onDelete("cascade");
            $table->bigInteger('provider_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('providers')
                ->onDelete("cascade");
            $table->timestamps();

            $table->foreign('facility_id')
                ->references('id')
                ->on('facilities')
                ->onDelete('cascade');

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
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
        Schema::dropIfExists('facility_provider');
    }
}
