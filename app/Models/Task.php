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
    public function shift()
    {
        return $this->belongsToMany(Shift::class, 'task_shift');
    }
}
