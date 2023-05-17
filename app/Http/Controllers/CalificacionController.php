<?php

namespace App\Http\Controllers;

use App\Models\AlumnoActividad;
use App\Models\Calificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CalificacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $alumnoActividades = DB::table('alumno_actividads')
            ->where('idAlumno','=', $request[1][0])
            ->where('idActividad', '=', $request[1][1])
        ->update([
            'calificacion' => $request[0]["calificacion"],
            'comentario' => $request[0]["comentario"]
        ]);
    }
    public function consultarDatos(Request $request)
    {
        //        return $request;
        $calificaciones = DB::table('asignaturas')
            ->select(['alumnos.id', 'alumnos.numeroLista', 'alumnos.grado', 'alumnos.grupo', 'alumnos.nombres', 'alumnos.apellidoP', 'alumnos.apellidoM', 'actividads.actividad as actividad', 'actividads.id as idActividad', 'alumno_actividads.calificacion'])
            ->join('rasgos', 'rasgos.idAsignatura', '=', 'asignaturas.id')
            ->join('actividads', 'actividads.idRasgo', '=', 'rasgos.id')
            ->join('alumno_actividads', 'alumno_actividads.idActividad', '=', 'actividads.id')
            ->join('alumnos', 'alumnos.id', '=', 'alumno_actividads.idAlumno')
            ->where('alumnos.grado', '=', $request->grado)
            ->where('alumnos.grupo', '=', $request->grupo)
            ->where('asignaturas.id', '=', $request->idAsignatura)
            ->where('rasgos.id', '=', $request->idRasgo)
            ->where('actividads.id', '=', $request->idActividad)
            ->where('alumnos.status', '=', 1)
            ->get();
        return $calificaciones;
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $calificaciones = DB::table('asignaturas')
            ->select(['alumnos.id', 'alumnos.numeroLista', 'alumnos.grado', 'alumnos.grupo', 'alumnos.nombres', 'alumnos.apellidoP', 'alumnos.apellidoM', 'actividads.actividad as actividad', 'actividads.id as idActividad', 'alumno_actividads.calificacion'])
            ->join('rasgos', 'rasgos.idAsignatura', '=', 'asignaturas.id')
            ->join('actividads', 'actividads.idRasgo', '=', 'rasgos.id')
            ->join('alumno_actividads', 'alumno_actividads.idActividad', '=', 'actividads.id')
            ->join('alumnos', 'alumnos.id', '=', 'alumno_actividads.idAlumno')
            ->where('alumno_actividads.id', '=', $id)
            ->get();
        return $calificaciones;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Calificacion $calificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Calificacion $calificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Calificacion $calificacion)
    {
        //
    }
}
