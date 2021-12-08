<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('users')
                ->onDelete("cascade");
            $table->string('first_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('last_name')->nullable();
            $table->integer('company_id')
                ->index()
                ->foreign()
                ->references("id")
                ->on('companies')
                ->onDelete("cascade");
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
            $table->tinyInteger('status')->default(0);
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

            $table->foreign('company_id')
                ->references('id')
                ->on('companies')
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
        Schema::dropIfExists('employees');
    }
}
