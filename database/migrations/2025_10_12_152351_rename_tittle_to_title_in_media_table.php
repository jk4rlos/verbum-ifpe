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
        if (Schema::hasColumn('media', 'tittle')) {
            Schema::table('media', function (Blueprint $table) {
                $table->renameColumn('tittle', 'title');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        if (Schema::hasColumn('media', 'title')) {
            Schema::table('media', function (Blueprint $table) {
                $table->renameColumn('title', 'tittle');
            });
        }
    }
};
