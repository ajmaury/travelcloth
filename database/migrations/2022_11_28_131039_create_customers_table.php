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
        if (!Schema::hasTable('oauth_access_tokens')) {
            Schema::create('customers', function (Blueprint $table) {
                $table->id();
                $table->string('accountId',100)->nullable();
                $table->string('fname')->nullable();
                $table->string('lname')->nullable();
                $table->string('email', 250)->unique();
                $table->string('password');
                $table->string('mobile')->unique()->nullable();
                $table->string('alternet_mobile')->nullable();
                $table->string('image',100)->nullable();
                $table->string('kyc_type',100)->nullable();
                $table->string('kyc_document',100)->nullable();
                $table->boolean('account_type')->nullable(); //0-customer,1-employee,2-partner agent,3-hotel master,4-associate
                $table->boolean('kyc_status')->default(0); //0-deactive,1-active
                $table->boolean('account_status')->default(0); //0-deactive,1-active
                $table->rememberToken();
                $table->timestamps();
            });
        }
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
