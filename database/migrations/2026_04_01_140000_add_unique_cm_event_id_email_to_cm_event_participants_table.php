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
        Schema::table('cm_event_participants', function (Blueprint $table) {
            $table->unique(['cm_event_id', 'email'], 'cm_event_participants_event_email_unique');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cm_event_participants', function (Blueprint $table) {
            $table->dropUnique('cm_event_participants_event_email_unique');
        });
    }
};
