<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;
use App\Models\Reserva;
use App\Models\Silla;
use App\Models\Sala;
use App\Models\User;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reservaciones = Reserva::join('users', 'reservas.user_id', '=', 'users.id')
            ->join('salas', 'reservas.sala_id', '=', 'salas.id')
            ->join('sillas', 'reservas.silla_id', '=', 'sillas.id')
            ->select('sillas.descripcion as descripcionSilla', 'salas.*', 'users.*', 'reservas.*')
            ->simplePaginate(5);

        return view('reservaciones.index', compact('reservaciones'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $salas = Sala::orderBy('nombre', 'asc')->get();
        $sillas = DB::select('SELECT DISTINCT * FROM sillas WHERE disponibilidad = "Si"');
        $usuarios = User::orderBy('name', 'asc')->get();

        return view('reservaciones.insert', compact('salas', 'sillas', 'usuarios'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreReservaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'user_id' => ['required'],
            'sala_id' => ['required'],
            'silla_id' => ['required']
        ]);

        $sala = Sala::all()->where('id', '=', $request->sala_id)->first();
        if (($user->edad < 18) && ($sala->nombre === "Sala A")) {
            Reserva::create($request->all());
            DB::table('sillas')
                ->where('id', $request->silla_id)
                ->update(['disponibilidad' => 'No']);
            return redirect()->route('reservaciones.index')->with('exito', 'Se ha registrado la reservacion exitosamente');
        } else if (($user->edad >= 18) && ($sala->nombre === "Sala B") && ($user->fumador == "Si")) {
            DB::table('sillas')
                ->where('id', $request->silla_id)
                ->update(['disponibilidad' => 'No']);
            Reserva::create($request->all());
            return redirect()->route('reservaciones.index')->with('exito', 'Se ha registrado la reservacion exitosamente');
        } else if (($user->edad >= 18) && ($sala->nombre === "Sala C") && ($user->fumador == "No")) {
            DB::table('sillas')
                ->where('id', $request->silla_id)
                ->update(['disponibilidad' => 'No']);
            Reserva::create($request->all());
            return redirect()->route('reservaciones.index')->with('exito', 'Se ha registrado la reservacion exitosamente');
        } else {
            return redirect()->route('reservaciones.index')->with('exito', 'Error');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = Auth::user();
        $reservacion = Reserva::join('users', 'reservas.user_id', '=', 'users.id')
            ->join('salas', 'reservas.sala_id', '=', 'salas.id')
            ->join('sillas', 'reservas.silla_id', '=', 'sillas.id')
            ->select('sillas.descripcion as descripcionSilla', 'salas.*', 'users.*', 'reservas.*')
            ->where('reservas.id', '=', $id)
            ->first();

        $cantidadReservas = DB::table('reservas')
            ->select()->count('*');

        return view('reservaciones.view', compact('reservacion', 'cantidadReservas', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $reserva = Reserva::findOrFail($id);
        $salas = Sala::orderBy('nombre', 'asc')->get();
        $sillas = Silla::orderBy('descripcion', 'asc')->get();
        $usuarios = User::orderBy('name', 'asc')->get();
        return view('reservaciones.edit', compact('sillas', 'salas', 'usuarios', 'reserva'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateReservaRequest  $request
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'user_id' => ['required'],
            'sala_id' => ['required'],
            'silla_id' => ['required']
        ]);
        $reserva = Reserva::findOrFail($id);
        $reserva->update($request->all());

        return redirect()->route('reservaciones.index')->with('exito', 'se ha modificado los datos de la reservacion exitosamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Reserva  $reserva
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reserva = Reserva::findOrFail($id);
        DB::table('sillas')
            ->where('id', $reserva->silla_id)
            ->update(['disponibilidad' => 'Si']);
        $reserva->delete();
        return redirect()->route('reservaciones.index')->with('exito', 'se ha eliminado la reservacion exitosamente');
    }
}
