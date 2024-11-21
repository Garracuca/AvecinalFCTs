<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeShift extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Relación uno a muchos con Turnos
    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }
}
