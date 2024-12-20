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
       
    ];

    protected $casts = [
        'start_date' => 'date', // Esto convierte start_date a una instancia de Carbon
    ];

    // Relación muchos a muchos con Meses
    public function month()
    {
        return $this->belongsTo(Month::class);
    }

    // Relación uno a muchos con los turnos
    public function shifts()
    {
        return $this->hasMany(Shift::class, 'week_id'); 
    }

    public function getWeekLabelAttribute()
    {
        $startDate = $this->start_date; // Fecha de inicio de la semana
    $firstDayOfMonth = $startDate->copy()->startOfMonth();
    $weekNumber = ceil($startDate->diffInDays($firstDayOfMonth) / 7) + 1; // Cálculo más preciso
    return chr(64 + $weekNumber); // Convierte el número de la semana a A, B, C...
}
}
