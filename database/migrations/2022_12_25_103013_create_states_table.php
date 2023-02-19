<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('states', function (Blueprint $table) {
            $table->id();
            $table->string('state_name')->unique()->nullable();
            $table->string('country_type')->default(0); //0-domestic, 1- international
            $table->bigInteger('country_id')->unsigned();
           //$table->foreignId('country_id')->nullable()->constrained()->onDelete('set null');
           $table->boolean('status')->default(0); //0-deactive,1-active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('states');
    }
}
