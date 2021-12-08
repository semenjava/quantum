<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitySpecialtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('facility_specialty', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('facility_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('facilities')
                ->onDelete("cascade");
            $table->integer('specialty_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('specialties')
                ->onDelete("cascade");
            $table->timestamps();

            $table->foreign('facility_id')
                ->references('id')
                ->on('facilities')
                ->onDelete('cascade');

            $table->foreign('specialty_id')
                ->references('id')
                ->on('specialties')
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
        Schema::dropIfExists('facility_specialty');
    }
}
