<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Week extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'month_id',
        'shift',
    ];

    // Relación uno a muchos con Turnos
    public function shift()
    {
        return $this->hasMany(Shift::class);
    }

    // Relación muchos a muchos con Meses
    public function months()
    {
        return $this->belongsToMany(Month::class, 'month_week');
    }
}
