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
        Schema::create('user_wallets', function (Blueprint $table) {
            $table->string('wallet_id')->primary(); // Set wallet_id as primary key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Link to User
            $table->decimal('wallet_balance', 10, 2)->default(0.00); // Default balance
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_wallets');
    }
};
