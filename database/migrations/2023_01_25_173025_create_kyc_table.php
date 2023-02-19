<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKycTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kyc', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->unsigned();
            $table->string('gst_certificate')->nullable();
            $table->string('c_incorporation')->nullable();
            $table->string('aadhar_front')->nullable();
            $table->string('aadhar_back')->nullable();
            $table->string('passport_1')->nullable();
            $table->string('passport_2')->nullable();
            $table->string('voterid_front')->nullable();
            $table->string('voterid_back')->nullable();
            $table->string('kyc_type',100)->nullable();
            $table->boolean('active_status')->default(1); //1-active,0-old
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
        Schema::dropIfExists('kyc');
    }
}
