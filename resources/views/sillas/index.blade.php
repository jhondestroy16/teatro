@extends('layouts.layout')
@section('titulo', 'Sillas')
@section('content')
    <h2 class="texto-blanco pt-5 pb-3">Sillas</h2>
    @if ($mensaje = Session::get('exito'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <p>{{ $mensaje }}</p>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <table class="table table-hover table-bordered table-striped alto-100">
        <thead>
            <tr>
                <th>Descripcion</th>
                <th>Sala</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($sillas as $silla)
                <tr>
                    <td> {{ $silla->descripcionSilla }} </td>
                    <td> {{ $silla->nombre }} </td>
                    <td>
                        <a href="{{ route('sillas.show', $silla->id) }}" class="btn btn-info">Detalles</a>
                        <a href="{{ route('sillas.edit', $silla->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('sillas.destroy', $silla->id) }}" method="post" class="d-inline-flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger"
                                onclick="return confirm('¿Desea eliminar la sala  {{ $silla->descripcion }}?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
    <div class="pt-3 pb-3">
        {{ $sillas->links() }}
    </div>
@endsection
