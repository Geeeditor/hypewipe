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
        Schema::create('user_available_wallets', function (Blueprint $table) {
            $table->id(); // Primary key for this table
            $table->string('user_wallet_id'); // Define the foreign key
            $table->foreign('user_wallet_id')->references('wallet_id')->on('user_wallets')->onDelete('cascade'); // Foreign key constraint
            $table->string('wallet_address');
            $table->string('wallet_name');
            $table->string('wallet_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_available_wallets');
    }
};
