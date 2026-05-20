<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('oceny', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uzytkownik_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('film_id')->constrained('filmy')->cascadeOnDelete();
            $table->unsignedTinyInteger('wartosc');
            $table->timestamp('data_oceny')->useCurrent();
            $table->unique(['uzytkownik_id', 'film_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('oceny');
    }
};