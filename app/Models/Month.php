<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Month extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'weeks',
    ];
    protected $casts = [
        'start_date' => 'date', // Esto convierte start_date a una instancia de Carbon
    ];

    // Relación uno a muchos con Semanas
    public function weeks()
    {
        return $this->hasMany(Week::class);
    }

  
}
