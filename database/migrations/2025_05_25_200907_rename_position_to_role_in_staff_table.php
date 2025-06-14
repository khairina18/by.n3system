<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->renameColumn('position', 'role');
        });
    }

    public function down()
    {
        Schema::table('staff', function (Blueprint $table) {
            $table->renameColumn('role', 'position');
        });
    }
};
