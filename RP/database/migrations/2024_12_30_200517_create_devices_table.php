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
        Schema::create('devices', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable(); // Optional: Device name (e.g., "John's iPhone")
            $table->string('device_token')->unique(); // API token for the device
            $table->string('user_agent')->nullable(); // Optional: User-Agent string
            $table->ipAddress('ip_address')->nullable(); // Optional: IP address of the device
            $table->string('icon')->nullable(); // Optional: IP address of the device
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devices');
    }
};
