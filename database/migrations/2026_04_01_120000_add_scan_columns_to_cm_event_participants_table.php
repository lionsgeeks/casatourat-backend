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
            $table->dateTime('scanned_at')->nullable()->after('phone_number');
            $table->string('validation_method', 50)->nullable()->after('scanned_at');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('cm_event_participants', function (Blueprint $table) {
            $table->dropColumn(['scanned_at', 'validation_method']);
        });
    }
};
