<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('confessions', function (Blueprint $table) {
            $table->time('time')->change();
        });
    }

    public function down(): void
    {
        Schema::table('confessions', function (Blueprint $table) {
            $table->integer('time')->change(); // ou o tipo que estava antes
        });
    }
};
