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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->string('service_type'); // Panel Damage, Junction Box, Hot-spot
            $table->string('name');
            $table->string('phone');
            $table->string('email');
            $table->string('city');
            $table->date('delivery_date');
            $table->string('invoice_no');
            $table->string('serial_number'); // Serial number of module/panel or Serial number & WP
            // File attachments - stored as JSON
            $table->json('attachments')->nullable();
            $table->enum('status', ['pending', 'in_progress', 'resolved', 'closed'])->default('pending');
            $table->text('admin_notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
