<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Sala;
use App\Models\Silla;
use App\Models\Reserva;

class SalaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $salas = Sala::orderBy('nombre', 'asc')->simplePaginate(5);

        return view('salas.index', compact('salas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('salas.insert');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSalaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => ['required'],
            'descripcion' => ['required']
        ]);
        $sala = Sala::create($request->all());

        return redirect()->route('salas.index')->with('exito', 'Se ha registrado la sala exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $sillas = Silla::join('salas', 'sillas.sala_id', '=', 'salas.id')
            ->select('sillas.descripcion as descripcionSilla', 'salas.*')
            ->where('sala_id', '=', $id)
            ->get();
        $reservas = Reserva::join('salas', 'reservas.sala_id', '=', 'salas.id')
            ->select('salas.*', 'reservas.*')
            ->get();
        $cantidadTotal = DB::table('reservas')
            ->select()
            ->count('*');
        $contadorSalaA = 0;
        $contadorSalaB = 0;
        $contadorSalaC = 0;
        foreach ($reservas as $reserva) {
            if ($reserva->nombre == "Sala A") {
                $contadorSalaA++;
            } else if ($reserva->nombre == "Sala B") {
                $contadorSalaB++;
            } else {
                $contadorSalaC++;
            }
        }
        $sala = Sala::FindOrFail($id);

        return view('salas.view', compact('sillas', 'sala', 'cantidadTotal','contadorSalaA','contadorSalaB','contadorSalaC'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sala = Sala::findOrFail($id);

        return view('salas.edit', compact('sala'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSalaRequest  $request
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => ['required'],
            'descripcion' => ['required']
        ]);
        $salas = Sala::findOrFail($id);
        $salas->update($request->all());

        return redirect()->route('salas.index')->with('exito', 'se ha modificado los datos de la sala exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sala  $sala
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $salas = Sala::findOrFail($id);
        $salas->delete();
        return redirect()->route('salas.index')->with('exito', 'se ha eliminado la sala exitosamente');
    }
}
