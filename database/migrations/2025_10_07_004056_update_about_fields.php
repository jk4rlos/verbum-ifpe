<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            // Só cria se a coluna ainda não existir
            if (!Schema::hasColumn('abouts', 'title')) {
                $table->string('title')->after('id');
            }

            // Remove a coluna antiga, se ainda existir
            if (Schema::hasColumn('abouts', 'tittle')) {
                $table->dropColumn('tittle');
            }

            // Remove 'image' se existir e adiciona 'images'
            if (Schema::hasColumn('abouts', 'image')) {
                $table->dropColumn('image');
            }

            if (!Schema::hasColumn('abouts', 'images')) {
                $table->json('images')->nullable()->after('content');
            }
        });
    }

    public function down(): void
    {
        Schema::table('abouts', function (Blueprint $table) {
            if (Schema::hasColumn('abouts', 'title')) {
                $table->dropColumn('title');
            }

            if (Schema::hasColumn('abouts', 'images')) {
                $table->dropColumn('images');
            }

            $table->string('tittle')->nullable();
            $table->string('image')->nullable();
        });
    }
};
