<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actividades = DB::table('rasgos')
            ->select(['actividads.id', 'asignaturas.asignatura as idAsignatura', 'grado', 'grupo', 'rasgo', 'actividads.actividad', 'actividads.status'])
            ->join('asignaturas', 'rasgos.idAsignatura', '=', 'asignaturas.id')
            ->join('actividads', 'actividads.idRasgo', '=', 'rasgos.id')
            ->where('actividads.status', '=', 1)
            ->get();
        return $actividades;
    }

    public function getActividadesXRasgo(Request $request){
        $actividades = DB::table('rasgos')
            ->select(['actividads.id', 'asignaturas.asignatura as idAsignatura', 'grado', 'grupo', 'rasgo', 'actividads.actividad', 'actividads.status'])
            ->join('asignaturas', 'rasgos.idAsignatura', '=', 'asignaturas.id')
            ->join('actividads', 'actividads.idRasgo', '=', 'rasgos.id')
            ->where('actividads.status', '=', 1)
            ->where('actividads.idRasgo','=', $request[0])
            ->get();
        return response()->json($actividades);
//        return $request[0];
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $rasgo = Actividad::create($request->all());
            return $rasgo;
        }catch(Exception $e ){
            return $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $rasgo = Actividad::where('id', $id)
            ->orderBy('actividad')
            ->first();
        return $rasgo;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Actividad $actividad)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Actividad $actividad)
    {
        $rasgo = Actividad::find($request->id);
        $rasgo->update($request->all());
        return $rasgo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rasgo = Actividad::where('id', $id)
            ->orderBy('rasgo')
            ->first();
        $rasgo->update(['status'=>0]);
        return $rasgo;
    }
}
