<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;

    protected $fillable = [
        'type_shift_id',
        'date',
        'hour',
        'duration',
        'user_id',
        'completed',
        'week_id',
    ];

    // Relación muchos a uno con el Tipo de Turno
    public function typeShift()
    {
        return $this->belongsTo(TypeShift::class,'type_shift_id');
    }

    // Relación muchos a uno con Usuarios
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relación muchos a uno con la Semana
    public function week()
    {
        return $this->belongsTo(Week::class);
    }

    // Relación muchos a muchos con las Tareas
    public function tasks()
    {
        return $this->belongsToMany(Task::class, 'task_shift');
    }
}
