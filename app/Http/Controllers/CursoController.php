<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Curso;

class CursoController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->all();
        $curso = Curso::create([
            'nombre' => $params['nombre'],
            'creditos' => $params['creditos'],
            'departamento_id' => $params['departamento_id'],
        ]);

        return $curso;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $size = isset($params['size']) ? $params['size'] : 5;

        $cursos = Curso::with('departamento.facultad.universidad')->where('departamento_id', $params['departamento_id'])
            ->limit($size)->get();

        return $cursos;
    }

    public function show($id)
    {
        $curso = Curso::find($id);

        return $curso;
    }

    public function update($id, Request $request)
    {
        $params = $request->all();
        Curso::find($id)->update([
            'nombre' => $params['nombre'],
            'creditos' => $params['creditos'],
            'departamento_id' => $params['departamento_id'],
        ]);

        return 'Registro actualizado';
    }

    public function destroy($id)
    {
        Curso::find($id)->delete();

        return 'Registro eliminado';
    }
}
