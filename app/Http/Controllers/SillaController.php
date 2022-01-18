<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Silla;
use App\Models\Sala;

class SillaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sillas = Silla::join('salas', 'sillas.sala_id', '=', 'salas.id')
            ->select('sillas.descripcion as descripcionSilla','sillas.disponibilidad', 'salas.*')
            ->orderBy('salas.nombre','asc')
            ->simplePaginate(5);

        return view('sillas.index', compact('sillas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salas = Sala::orderBy('nombre', 'asc')->get();

        return view('sillas.insert', compact('salas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSillaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'descripcion' => ['required'],
            'sala_id' => ['required']
        ]);
        $silla = Silla::create($request->all());

        return redirect()->route('sillas.index')->with('exito', 'Se ha registrado la silla exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Silla  $silla
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sala = Silla::join('salas', 'sillas.sala_id', '=', 'salas.id')
            ->select('sillas.id', 'sillas.descripcion as descripcionSilla', 'salas.*')
            ->where('sillas.id', '=', $id)
            ->first();
        $cantidadTotal = DB::table('sillas')
            ->select()
            ->count('*');
        $silla = Silla::findOrFail($id);

        return view('sillas.view', compact('silla', 'sala', 'cantidadTotal'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Silla  $silla
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $silla = Silla::findOrFail($id);
        $salas = Sala::orderBy('nombre', 'asc')->get();

        return view('sillas.edit', compact('silla', 'salas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSillaRequest  $request
     * @param  \App\Models\Silla  $silla
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'descripcion' => ['required'],
            'sala_id' => ['required']
        ]);
        $sillas = Silla::findOrFail($id);
        $sillas->update($request->all());

        return redirect()->route('sillas.index')->with('exito', 'se ha modificado los datos de la silla exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Silla  $silla
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $silla = Silla::findOrFail($id);
        $silla->delete();
        return redirect()->route('sillas.index')->with('exito', 'se ha eliminado la silla exitosamente');
    }
}
