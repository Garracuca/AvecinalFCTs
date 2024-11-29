<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{

    use HasFactory;

    protected $fillable = [
        'tipodeturno',
        'date',
        'hour',
        'duration',
        'user_id',
        'completed',
        'week_id',
    ];

    // Relaciones con otros modelos
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function week()
    {
        return $this->belongsTo(Week::class, 'week_id'); // Relación inversa con Week
    }
}
