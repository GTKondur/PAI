<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class FilmGatunek extends Pivot
{
    public $timestamps = false;
    protected $table = 'film_gatunek';
}