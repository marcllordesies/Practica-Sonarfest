<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('artista_genere')) {
            Schema::create('artista_genere', function (Blueprint $table) {
                $table->foreignId('artista_id')->constrained('artistas')->onDelete('cascade');
                $table->foreignId('genere_id')->constrained('generes')->onDelete('cascade');
                $table->primary(['artista_id', 'genere_id']);
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('artista_genere');
    }
};
