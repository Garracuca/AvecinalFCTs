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
}
