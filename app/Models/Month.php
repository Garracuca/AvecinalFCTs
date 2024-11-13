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

    // Relación uno a muchos con Semanas
    public function weeks()
    {
        return $this->belongsToMany(Week::class, 'month_week');
    }
   
}
