<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('film_gatunek', function (Blueprint $table) {
            $table->foreignId('film_id')->constrained('filmy')->cascadeOnDelete();
            $table->foreignId('gatunek_id')->constrained('gatunki')->cascadeOnDelete();
            $table->primary(['film_id', 'gatunek_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('film_gatunek');
    }
};