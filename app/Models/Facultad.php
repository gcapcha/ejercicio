<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Facultad extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'facultades';

    protected $fillable = [
        'nombre',
        'universidad_id',
    ];

    #Llamamos a los hijos de facultad
    public function departamentos()
    {
        return $this->hasMany(Departamento::class, 'facultad_id');
    }

    #Llamamos al padre de facultad
    public function universidad()
    {
        return $this->belongsTo(Universidad::class, 'universidad_id');
    }

    #LLamamos a la relacion de *-* para los cursos
    public function facultadCurso()
    {
        return $this->hasMany(FacultadCurso::class, 'facultad_id');
    }
}
