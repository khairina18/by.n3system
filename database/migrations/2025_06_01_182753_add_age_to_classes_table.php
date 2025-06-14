<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->enum('age', ['Standard 3', 'Standard 4', 'Standard 5', 'Standard 6', 'Form 1', 'Form 2', 'Form 3', 'Form 4', 'Form 5'])
            ->after('subject'); 
        });
    }

    public function down()
    {
        Schema::table('classes', function (Blueprint $table) {
            $table->dropColumn('age');
        });
    }
};
