<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
{
    Schema::table('students', function (Blueprint $table) {
        $table->string('age')->change();
    });
}

public function down()
{
    Schema::table('students', function (Blueprint $table) {
        $table->integer('age')->change(); // rollback
    });
}

};
