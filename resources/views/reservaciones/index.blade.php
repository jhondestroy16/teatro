@extends('layouts.layout')
@section('titulo', 'Reservaciones')
@section('content')
    <h2 class="texto-blanco pt-5 pb-3 h1">Reservaciones</h2>
    @if ($mensaje = Session::get('exito'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ $mensaje }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table table-hover table-bordered table-striped alto-100">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Sala</th>
                <th>Silla</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @if(count($reservaciones) > 0)
            @foreach ($reservaciones as $reservacion)
                <tr>
                    <td> {{ $reservacion->name }} </td>
                    <td> {{ $reservacion->nombre }} </td>
                    <td> {{ $reservacion->descripcionSilla }} </td>
                    <td>
                        <a href="{{ route('reservaciones.show', $reservacion->id) }}" class="btn btn-info">Detalles</a>
                        <a href="{{ route('reservaciones.edit', $reservacion->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('reservaciones.destroy', $reservacion->id) }}" method="post" class="d-inline-flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Desea eliminar la reservacion  {{ $reservacion->descripcion }}?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            @else
                <tr>
                    <td class="text-center" colspan="4">No se encontraron registros</td>
                </tr>
            @endif
        </tbody>
    </table>
    <div class="pt-3 pb-3">
        {{ $reservaciones->links() }}
    </div>
@endsection
