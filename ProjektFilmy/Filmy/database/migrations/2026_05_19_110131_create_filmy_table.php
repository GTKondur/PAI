<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('filmy', function (Blueprint $table) {
            $table->id();
            $table->string('tytul', 255);
            $table->string('tytul_oryginalny', 255)->nullable();
            $table->smallInteger('rok_produkcji')->nullable();
            $table->text('opis')->nullable();
            $table->unsignedSmallInteger('czas_trwania_min')->nullable();
            $table->string('plakat_url', 500)->nullable();
            $table->string('rezyser', 255)->nullable();
            $table->enum('typ', ['film', 'serial'])->default('film');
            $table->foreignId('dodane_przez')->nullable()->constrained('users')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('filmy');
    }
};