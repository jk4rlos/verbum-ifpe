<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('weekly_warnings', function (Blueprint $table) {
            if (Schema::hasColumn('weekly_warnings', 'tittle')) {
                $table->renameColumn('tittle', 'title');
            }
        });
    }

    public function down(): void
    {
        Schema::table('weekly_warnings', function (Blueprint $table) {
            if (Schema::hasColumn('weekly_warnings', 'title')) {
                $table->renameColumn('title', 'tittle');
            }
        });
    }
};
