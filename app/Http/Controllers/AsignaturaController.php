<?php

namespace App\Http\Controllers;

use App\Models\Asignatura;
use Exception;
use Illuminate\Http\Request;

class AsignaturaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignaturas = Asignatura::where('status', 1)
            ->orderBy('asignatura')
            ->get();
        return $asignaturas;
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $asignatura = Asignatura::create($request->all());
            return $asignatura;
        }catch(Exception $e ){
            return $e;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $asignatura = Asignatura::where('id', $id)
            ->orderBy('asignatura')
            ->first();
        return $asignatura;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Asignatura $asignatura)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $asignatura = Asignatura::find($request->id);
        $asignatura->update($request->all());
        return $asignatura;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $asignatura = Asignatura::where('id', $id)
            ->orderBy('asignatura')
            ->first();
        $asignatura->update(['status'=>0]);
        return $asignatura;
    }
}
