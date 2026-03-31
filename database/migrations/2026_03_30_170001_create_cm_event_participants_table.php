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
        Schema::create('cm_event_participants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('cm_event_id')->constrained('cm_events')->cascadeOnDelete();
            $table->string('full_name');
            $table->string('email');
            $table->string('phone_number');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cm_event_participants');
    }
};
