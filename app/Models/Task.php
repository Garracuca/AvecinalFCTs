<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    // Relación muchos a muchos con Turnos
    public function turns()
    {
        return $this->belongsToMany(Turn::class, 'task_turn');
    }
}
