<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('concerts', function (Blueprint $table) {
            $table->foreignId('escenari_id')
                ->after('artista_id')
                ->constrained('escenaris')
                ->cascadeOnDelete();
        });
    }
    public function down(): void
    {
        Schema::table('concerts', function (Blueprint $table) {
            $table->dropForeign(['escenari_id']);
            $table->dropColumn('escenari_id');
        });
    }
};
