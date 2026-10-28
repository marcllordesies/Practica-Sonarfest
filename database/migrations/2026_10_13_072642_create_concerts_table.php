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
        Schema::create('concerts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('artista_id')->constrained('artistas')->cascadeOnDelete();

            // nom (string, not null)
            $table->string('nom');

            // data_hora (dateTime, not null)
            $table->dateTime('data_hora');

            // durada_minuts (unsignedInteger, not null)
            $table->unsignedInteger('durada_minuts');

            // tipus (enum, not null)
            $table->enum('tipus', ['CONCERT', 'DJ_SET', 'SHOWCASE', 'ACUSTIC']);

            // timestamps (created_at + updated_at)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('concerts');
    }
};
