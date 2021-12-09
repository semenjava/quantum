<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('users')
                ->onDelete("cascade");
            $table->string('name');
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
            $table->string('address')->nullable();
            $table->string('postal')->nullable();
            $table->string('phone')->nullable();
            $table->string('fax')->nullable();
            $table->integer('count_employee')->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');

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
        Schema::dropIfExists('companies');
    }
}
