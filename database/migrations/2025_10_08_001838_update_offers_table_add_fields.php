<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            if (!Schema::hasColumn('offers', 'tittle')) {
                $table->string('tittle')->nullable();
            }

            if (!Schema::hasColumn('offers', 'pix')) {
                $table->string('pix')->nullable();
            }

            if (!Schema::hasColumn('offers', 'bank')) {
                $table->string('bank')->nullable();
            }

            if (!Schema::hasColumn('offers', 'qrcode')) {
                $table->string('qrcode')->nullable();
            }

            if (!Schema::hasColumn('offers', 'description')) {
                $table->text('description')->nullable();
            }
        });
    }

    public function down(): void
    {
        Schema::table('offers', function (Blueprint $table) {
            if (Schema::hasColumn('offers', 'tittle')) {
                $table->dropColumn('tittle');
            }

            if (Schema::hasColumn('offers', 'pix')) {
                $table->dropColumn('pix');
            }

            if (Schema::hasColumn('offers', 'bank')) {
                $table->dropColumn('bank');
            }

            if (Schema::hasColumn('offers', 'qrcode')) {
                $table->dropColumn('qrcode');
            }

            if (Schema::hasColumn('offers', 'description')) {
                $table->dropColumn('description');
            }
        });
    }
};

