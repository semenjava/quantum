<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProviderSpecialtyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('provider_specialty', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('provider_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('providers')
                ->onDelete("cascade");
            $table->integer('specialty_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('specialties')
                ->onDelete("cascade");
            $table->timestamps();

            $table->foreign('provider_id')
                ->references('id')
                ->on('providers')
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
        Schema::dropIfExists('provider_specialty');
    }
}
