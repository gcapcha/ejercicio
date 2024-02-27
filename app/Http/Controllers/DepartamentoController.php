<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Departamento;

class DepartamentoController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->all();
        $departamento = Departamento::create([
            'nombre' => $params['nombre'],
            'facultad_id' => $params['facultad_id']
        ]);

        return $departamento;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $size = isset($params['size']) ? $params['size'] : 5;

        $departamentos = Departamento::select('id', 'nombre', 'facultad_id')
            ->with('facultad')->where('facultad_id', $params['facultad_id'])
            ->limit($size)->get();

        return $departamentos;
    }

    public function show($id)
    {
        $departamento = Departamento::find($id);

        return $departamento;
    }

    public function update($id, Request $request)
    {
        $params = $request->all();
        Departamento::find($id)->update([
            'nombre' => $params['nombre'],
            'facultad_id' => $params['facultad_id']
        ]);

        return 'Registro actualizado';
    }

    public function destroy($id)
    {
        Departamento::find($id)->delete();

        return 'Registro eliminado';
    }
}
