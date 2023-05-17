<?php

namespace App\Http\Controllers;

use App\Models\Alumno;
use App\Models\AlumnoActividad;
use App\Models\Asignatura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PHPUnit\Exception;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $alumnos = Alumno::where('status', 1)
            ->orderBy('nombres')
            ->get();
        return $alumnos;
    }

    public function busquedaGradoGrupoTurno(Request $request)
    {
        //FALTA EL TURNO
        $asignatura = DB::table('asignaturas')
            ->select(['grado', 'grupo'])
            ->where('id', $request->idAsignatura)
            ->first();
        $alumnos = DB::table('alumnos')
            ->select(['id', 'nombres'])
            ->where('grado', $asignatura->grado)
            ->where('grupo', $asignatura->grupo)
            ->get();
//        return $alumnos;

        foreach ($alumnos as $alumno) {
            //AlumnoActividad::create($alumno->idAlumno);
            //$alumno = Alumno::create($request->all());
//            echo $alumno->nombres;

            $aa = new AlumnoActividad;
//
            $aa->idAlumno = $alumno->id;
            $aa->idActividad = $request->idAsignatura;
            $aa->calificacion = 0;
            $aa->status = 1;
//
            $aa->save();
        }

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
            $alumno = Alumno::create($request->all());
            return $alumno;
        }catch(Exception $e ){
            return $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $alumno = Alumno::where('id', $id)
            ->orderBy('nombres')
            ->first();
        return $alumno;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //return $id;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $alumno = Alumno::find($request->id);
        $alumno->update($request->all());
        return $alumno;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $alumno = Alumno::where('id', $id)
            ->orderBy('nombres')
            ->first();
        $alumno->update(['status'=>0]);
        return $alumno;
    }
}
