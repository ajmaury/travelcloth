<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('quotes', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('mobile')->nullable();
            $table->string('pickup_destination')->nullable();
            $table->string('pickup_pincode')->nullable();
            $table->string('drop_destination')->nullable();
            $table->string('drop_pincode')->nullable();
            $table->string('no_of_bag')->nullable();
            $table->string('total')->nullable();
            $table->string('tax')->nullable();
            $table->string('grand_total')->nullable();
            $table->string('user_id')->nullable();
            $table->boolean('account_type')->nullable(); //0-customer,2-partner agent,3-hotel master,4-associate,5-default
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
        Schema::dropIfExists('quotes');
    }
}
