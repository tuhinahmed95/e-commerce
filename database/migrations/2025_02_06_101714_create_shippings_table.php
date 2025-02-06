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
        Schema::create('shippings', function (Blueprint $table) {
            $table->id();
            $table->string('order_id');
            $table->string('shif_fname');
            $table->string('shif_lname')->nullable();
            $table->integer('shif_country_id');
            $table->integer('shif_city_id');
            $table->integer('shif_zip');
            $table->string('shif_company')->nullable();
            $table->string('shif_email')->nullable();
            $table->string('shif_phone');
            $table->string('shif_address');
            $table->string('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('shippings');
    }
};
