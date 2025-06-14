<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('group_schedules', function (Blueprint $table) {
        $table->id();
        $table->string('day'); // e.g. "Monday"
        $table->time('time');
        $table->time('end_time');
        $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
        $table->foreignId('staff_id')->constrained('staff')->onDelete('cascade');
        $table->timestamps();
    });
    }

    public function down(): void
    {
        Schema::dropIfExists('group_schedules');
    }
};
