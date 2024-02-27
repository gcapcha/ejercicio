<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Facultad;

class FacultadController extends Controller
{
    public function store(Request $request)
    {
        $params = $request->all();
        $facultad = Facultad::create([
            'nombre' => $params['nombre'],
            'universidad_id' => $params['universidad_id']
        ]);

        return $facultad;
    }

    public function index(Request $request)
    {
        #llamar a los atributos de nuestra peticion HTTP
        $params = $request->all();
        #ternario para reducir un IF
        $size = isset($params['size']) ? $params['size'] : 5;

        $facultades = Facultad::with('universidad')->where('universidad_id', $params['universidad_id'])
            ->limit($size)->get();

        return $facultades;
    }

    public function show($id)
    {
        $facultad = Facultad::find($id);

        return $facultad;
    }

    public function update($id, Request $request)
    {
        $params = $request->all();
        Facultad::find($id)->update([
            'nombre' => $params['nombre'],
            'universidad_id' => $params['universidad_id']
        ]);

        return 'Registro actualizado';
    }

    public function destroy($id)
    {
        Facultad::find($id)->delete();

        return 'Registro eliminado';
    }
}
