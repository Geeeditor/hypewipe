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
        Schema::create('quests', function (Blueprint $table) {
            $table->id();
            $table->json('image'); // e.g., Image
            $table->string('make'); // e.g., Toyota, Ford
            $table->string('model'); // e.g., Corolla, Mustang
            $table->year('year'); // Year of manufacture
            $table->string('color'); // Color of the vehicle
            $table->string('vin')->unique(); // Vehicle Identification Number
            $table->integer('mileage')->nullable(); // Mileage in kilometers or miles
            $table->string('engine_type')->nullable(); // e.g., Gasoline, Diesel, Electric
            $table->string('transmission')->nullable(); // e.g., Automatic, Manual
            $table->string('fuel_type')->nullable(); // e.g., Gas, Electric, Hybrid
            $table->decimal('price', 10, 2); // Price of the vehicle
            $table->decimal('quest_cost', 10, 2);
            $table->integer('quest_commission');
            $table->text('description')->nullable(); // Additional information about the car
            $table->timestamps(); // Created at and updated at timestamps
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quests');
    }
};
