<?php

namespace App\Http\Controllers;

use App\Models\Rasgo;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RasgoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
//        $rasgo = Rasgo::where('status', 1)
//            ->orderBy('rasgo')
//            ->get();

        $rasgo = DB::table('rasgos')
            ->select(['rasgos.id', 'asignaturas.asignatura as idAsignatura', 'grado', 'grupo', 'rasgo', 'porcentaje', 'rasgos.status'])
            ->join('asignaturas', 'rasgos.idAsignatura', '=', 'asignaturas.id')
            ->where('rasgos.status','=', 1)
            ->get();
        return $rasgo;
    }

    public function rasgoResumen(Request $request)
    {
//        return $request;
//        //$total = 0;
        $porcentajes = DB::table('rasgos')
            ->select(['asignaturas.asignatura as asignatura', 'rasgo', 'porcentaje', 'rasgos.status'])
            ->join('asignaturas', 'rasgos.idAsignatura', '=', 'asignaturas.id')
            ->where('asignaturas.asignatura', $request->get('asignatura'))
            ->where('grado', $request->get('grado'))
            ->where('grupo', $request->get('grupo'))
            ->get();

        return $porcentajes;

//        foreach ($porcentajes as $porcentaje){
//            $total = $total + $porcentaje->porcentaje;
//        }
//        return $total;
    }

    public function getGrafico(Request $request){
        $grafico = DB::table('rasgos')
            ->select(['asignaturas.asignatura as name', 'porcentaje as value'])
            ->join('asignaturas', 'rasgos.idAsignatura', '=', 'asignaturas.id')
            ->where('asignaturas.asignatura', $request->get('asignatura'))
            ->where('grado', $request->get('grado'))
            ->where('grupo', $request->get('grupo'))
            ->get();

        return $grafico;
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
            $rasgo = Rasgo::create($request->all());
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
        $rasgo = Rasgo::where('id', $id)
            ->orderBy('rasgo')
            ->first();
        return $rasgo;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Rasgo $rasgo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Rasgo $rasgo)
    {
        $rasgo = Rasgo::find($request->id);
        $rasgo->update($request->all());
        return $rasgo;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $rasgo = Rasgo::where('id', $id)
            ->orderBy('rasgo')
            ->first();
        $rasgo->update(['status'=>0]);
        return $rasgo;
    }
}
