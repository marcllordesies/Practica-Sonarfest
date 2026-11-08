<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('entrades', function (Blueprint $table) {
            $table->id();
            $table->foreignId('concert_id')->constrained('concerts')->onDelete('cascade');
            $table->string('codi')->unique();
            $table->decimal('preu_pagat', 8, 2);
            $table->string('nom_complet');
            $table->string('email');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('entrades');
    }
};
