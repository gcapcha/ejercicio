<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Departamento extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'facultad_id',
    ];

    #Padre de departamento
    public function facultad()
    {
        return $this->belongsTo(Facultad::class, 'facultad_id');
    }
}
