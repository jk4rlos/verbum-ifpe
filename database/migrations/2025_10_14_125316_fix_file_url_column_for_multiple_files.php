<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('media', function (Blueprint $table) {
            // Adicionar coluna temporária com tipo TEXT
            $table->text('file_url_temp')->nullable()->after('file_url');

            // Se houver dados existentes, tentar preservar (embora os registros atuais pareçam vazios)
            // Em caso de erro, a coluna temporária ficará vazia
            try {
                DB::statement('UPDATE media SET file_url_temp = file_url WHERE file_url IS NOT NULL AND file_url != ""');
            } catch (\Exception $e) {
                // Se houver erro, continuar sem os dados antigos
            }

            // Remover a coluna original
            $table->dropColumn('file_url');

            // Renomear a coluna temporária
            $table->renameColumn('file_url_temp', 'file_url');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('media', function (Blueprint $table) {
            // Reverter: adicionar coluna temporária string
            $table->string('file_url_temp')->after('file_url');

            // Copiar dados de volta (se houver)
            try {
                DB::statement('UPDATE media SET file_url_temp = file_url WHERE file_url IS NOT NULL AND file_url != ""');
            } catch (\Exception $e) {
                // Se houver erro, continuar
            }

            // Remover TEXT e renomear de volta
            $table->dropColumn('file_url');
            $table->renameColumn('file_url_temp', 'file_url');
        });
    }
};
