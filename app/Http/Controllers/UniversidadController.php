<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Universidad;

class UniversidadController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->all();
        $universidad = Universidad::create([
            'nombre' => $params['nombre'],
            'direccion' => $params['direccion'],
            'antiguedad' => $params['antiguedad'],
        ]);

        return $universidad;
    }

    public function index(Request $request)
    {
        $params = $request->all();
        $size = isset($params['size']) ? $params['size'] : 5;

        $universidades = Universidad::with('facultades')->where('antiguedad', '>=', $params['antiguedad'])
            ->limit($size)->get();

        return $universidades;
    }

    public function show($id)
    {
        $universidad = Universidad::find($id);

        return $universidad;
    }

    public function update($id, Request $request)
    {
        $params = $request->all();
        Universidad::find($id)->update([
            'nombre' => $params['nombre'],
            'direccion' => $params['direccion'],
            'antiguedad' => $params['antiguedad'],
        ]);

        return 'Registro actualizado';
    }

    public function destroy($id)
    {
        Universidad::find($id)->delete();

        return 'Registro eliminado';
    }
}
