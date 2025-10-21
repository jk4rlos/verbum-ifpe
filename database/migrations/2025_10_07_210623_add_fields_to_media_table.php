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
        Schema::table('media', function (Blueprint $table) {
            $table->string('title')->after('id');
            $table->string('type')->after('title');
            $table->string('url')->after('type');
            $table->string('description', 255)->nullable()->after('url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            $table->dropColumn(['title', 'type', 'url', 'description']);
        });
    }
};
