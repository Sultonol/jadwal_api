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
        Schema::table('schedules', function (Blueprint $table) {
        $table->dropColumn('subject');
        $table->dropColumn('room');
        $table->foreignId('course_id')->nullable()->constrained()->after('id');
        $table->foreignId('room_id')->nullable()->constrained()->after('time_end');
        $table->foreignId('user_id')->nullable()->constrained()->after('room_id');
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropForeign(['room_id']);
        $table->dropForeign(['course_id']);
        $table->dropColumn(['user_id', 'room_id', 'course_id']);
        $table->string('subject');
        $table->string('room')->nullable();
        });
    }
};
