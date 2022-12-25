<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogisticsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
       // if (!Schema::hasTable('oauth_access_tokens')) {
            Schema::create('logistics', function (Blueprint $table) {
                $table->id();
                $table->string('logisticId',100)->nullable();
                $table->string('fname')->nullable();
                $table->string('lname')->nullable();
                $table->string('city')->nullable();
                $table->string('email', 250)->unique();
                $table->string('mobile')->unique()->nullable();
                $table->boolean('status')->default(0); //0-deactive,1-active
                $table->timestamps();
            });
       // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('logistics');
    }
}
