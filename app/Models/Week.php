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


    // Relación muchos a muchos con Meses
    public function months()
    {
        return $this->belongsToMany(Month::class, 'month_week');
    }

        // Relación uno a muchos con los turnos
        public function shifts()
        {
            return $this->hasMany(Shift::class, 'week_id'); 
        }
}
