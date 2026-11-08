<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('concerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artista_id')->constrained('artistas')->cascadeOnDelete();
            $table->string('nom');
            $table->dateTime('data_hora');
            $table->unsignedInteger('durada_minuts');
            $table->enum('tipus', ['CONCERT', 'DJ_SET', 'SHOWCASE', 'ACUSTIC']);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('concerts');
    }
};
