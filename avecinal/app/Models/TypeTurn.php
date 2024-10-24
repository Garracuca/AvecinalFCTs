<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTurn extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Relación uno a muchos con Turnos
    public function turns()
    {
        return $this->hasMany(Turn::class);
    }
}
