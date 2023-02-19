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
                $table->string('cname')->nullable(); //c -company name
                $table->string('cpname')->nullable(); //cp - contact person
                $table->string('cpdesignation')->nullable();
              //  $table->string('cpemail', 250)->unique();
                $table->string('cpmobile')->unique()->nullable();
                $table->string('gstin')->nullable();
                $table->string('bankname')->nullable();
                $table->string('accountnumber')->nullable();
                $table->string('ifsccode')->nullable();
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
