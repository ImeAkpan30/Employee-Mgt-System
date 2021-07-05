<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->bigIncrements('id', true);
            $table->string('lastname', 60);
            $table->string('firstname', 60);
            $table->string('middlename', 60);
            $table->string('address', 120);
            $table->unsignedBigInteger('cities_id');
            $table->unsignedBigInteger('states_id');
            $table->unsignedBigInteger('countries_id');;
            $table->foreign('cities_id')->references('id')->on('cities')->onDelete('cascade');
            $table->foreign('states_id')->references('id')->on('states')->onDelete('cascade');
            $table->foreign('countries_id')->references('id')->on('countries')->onDelete('cascade');
            $table->char('zip', 10);
            $table->integer('age')->unsigned();
            $table->date('birthdate');
            $table->date('date_hired');
            $table->unsignedBigInteger('departments_id');
            $table->unsignedBigInteger('divisions_id');
            $table->foreign('departments_id')->references('id')->on('departments')->onDelete('cascade');
            $table->foreign('divisions_id')->references('id')->on('divisions')->onDelete('cascade');
            $table->string('picture', 60);
            $table->timestamps();
            $table->softDeletes();
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
