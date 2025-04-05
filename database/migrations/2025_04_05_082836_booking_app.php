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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('customer_id')->constrained('customers')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
            $table->timestamp('booking_timestamp');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
        Schema::dropIfExists('bookings');
    }
};
