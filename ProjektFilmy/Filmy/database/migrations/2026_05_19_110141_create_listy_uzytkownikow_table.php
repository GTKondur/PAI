<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('listy_uzytkownikow', function (Blueprint $table) {
            $table->id();
            $table->foreignId('uzytkownik_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('film_id')->constrained('filmy')->cascadeOnDelete();
            $table->enum('status', ['chce_obejrzec', 'oglądam', 'obejrzane', 'porzucone'])->default('chce_obejrzec');
            $table->date('data_dodania')->useCurrent();
            $table->date('data_obejrzenia')->nullable();
            $table->unique(['uzytkownik_id', 'film_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('listy_uzytkownikow');
    }
};