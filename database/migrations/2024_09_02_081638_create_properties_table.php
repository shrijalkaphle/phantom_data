<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->text('mail_address')->nullable();
            $table->text('mail_city')->nullable();
            $table->text('mail_state')->nullable();
            $table->text('mail_zip')->nullable();
            $table->text('property_address')->nullable();
            $table->text('property_city')->nullable();
            $table->text('property_state')->nullable();
            $table->text('property_zip')->nullable();

            $table->text('response')->nullable();
            $table->text('name')->nullable();
            $table->text('age')->nullable();
            $table->json('addresses')->nullable();
            $table->json('phones')->nullable();
            $table->json('emails')->nullable();
            $table->json('personal_details')->nullable();
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
        Schema::dropIfExists('properties');
    }
};
