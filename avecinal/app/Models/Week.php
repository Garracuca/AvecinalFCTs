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
        'turns',
    ];

    // Relación uno a muchos con Turnos
    public function turns()
    {
        return $this->hasMany(Turn::class);
    }

    // Relación muchos a uno con Meses
    public function month()
    {
        return $this->belongsTo(Month::class);
    }
}
