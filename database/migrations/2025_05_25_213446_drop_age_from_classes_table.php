<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn('age');
        });
    }

    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->string('age')->nullable(); // Adjust type if needed
        });
    }
};
