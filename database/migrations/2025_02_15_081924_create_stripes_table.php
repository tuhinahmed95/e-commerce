<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stripes', function (Blueprint $table) {
            $table->id();
            $table->integer('customer_id');
            $table->integer('charge');
            $table->integer('discount');
            $table->integer('total');
            $table->integer('shif_check');
            $table->string('fname');
            $table->string('lname')->nullable();
            $table->string('email');
            $table->string('phone');
            $table->integer('country');
            $table->integer('city');
            $table->integer('zip');
            $table->string('company')->nullable();
            $table->string('address');
            $table->string('notes')->nullable();
            $table->string('shif_fname')->nullable();
            $table->string('shif_lname')->nullable();
            $table->string('shif_email')->nullable();
            $table->string('shif_phone')->nullable();
            $table->integer('shif_country')->nullable();
            $table->integer('shif_city')->nullable();
            $table->string('shif_zip')->nullable();
            $table->string('shif_company')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stripes');
    }
};
