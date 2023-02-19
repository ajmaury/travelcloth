<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //if (!Schema::hasTable('oauth_access_tokens')) {
            Schema::create('customers', function (Blueprint $table) {
                $table->id();
                $table->string('accountId',100)->nullable();
                $table->string('country_id')->nullable();
                $table->string('state_id')->nullable();
                $table->string('city_id')->nullable();
                $table->string('pincode_id')->nullable();
                $table->string('address_line1')->nullable();
                $table->string('address_line2')->nullable();
                $table->string('fname')->nullable();
                $table->string('lname')->nullable();
                $table->string('email', 250)->unique();
                $table->string('employeeId')->nullable(); 
                $table->string('companyName')->nullable(); 
                $table->string('hotelName')->nullable();
                $table->string('password');
                $table->string('mobile')->unique()->nullable();
                $table->string('alternet_mobile')->nullable();
                $table->string('image',100)->nullable();
                $table->string('kyc_type',100)->nullable();
                $table->string('kyc_document',100)->nullable();
                $table->boolean('mobile_verification_status')->default(0); //0-verify,1-not verify
                $table->boolean('account_type')->nullable(); //0-customer,1-employee,2-partner agent,3-hotel master,4-associate
                $table->boolean('kyc_status')->nullable(); 
                $table->boolean('account_status')->default(0); //0-deactive,1-active
                $table->rememberToken();
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
        Schema::dropIfExists('customers');
    }
}
