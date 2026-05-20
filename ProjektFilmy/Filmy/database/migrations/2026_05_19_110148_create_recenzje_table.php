<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('recenzje', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uzytkownik_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('film_id')->constrained('filmy')->cascadeOnDelete();
            $table->text('tresc');
            $table->boolean('ukryta')->default(false);
            $table->foreignId('ukryta_przez')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamp('data_dodania')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('recenzje');
    }
};