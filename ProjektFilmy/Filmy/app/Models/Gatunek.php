<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Gatunek extends Model
{
    protected $table = 'gatunki';
    public $timestamps = false;

    protected $fillable = ['nazwa'];

    public function filmy(): BelongsToMany
    {
        return $this->belongsToMany(Film::class, 'film_gatunek', 'gatunek_id', 'film_id');
    }
}