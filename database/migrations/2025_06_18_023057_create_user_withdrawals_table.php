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
        Schema::create('user_withdrawals', function (Blueprint $table) {
            $table->id();
            $table->string('users_email'); // Foreign key
            $table->foreign('users_email')->references('email')->on('users')->onDelete('cascade');
            $table->string('wallet_address');
            $table->string('wallet_name');
            $table->string('wallet_type');
            $table->string('wallet_id');// wallet uniqe identification string
            $table->string('transaction_status')->default('pending');// wallet uniqe identification string
            $table->decimal('withdrawal_amount', 10, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_withdrawals');
    }
};
