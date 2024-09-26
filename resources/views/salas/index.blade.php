@extends('layouts.layout')
@section('titulo', 'Salas')
@section('content')
    <h2 class="texto-blanco pt-5 pb-3 h1">Salas</h2>
    @if($mensaje = Session::get('exito'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <p>{{ $mensaje }}</p>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif
    <table class="table table-hover table-bordered table-striped alto-100">
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Descripcion</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($salas as $sala)
                <tr>
                    <td> {{ $sala->nombre }} </td>
                    <td> {{ $sala->descripcion }} </td>
                    <td>
                        <a href="{{ route('salas.show', $sala->id) }}" class="btn btn-info">Detalles</a>
                        <a href="{{ route('salas.edit', $sala->id) }}" class="btn btn-warning">Editar</a>
                        <form action="{{ route('salas.destroy', $sala->id) }}" method="post" class="d-inline-flex">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('¿Desea eliminar la sala  {{ $sala->nombre }}?')">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pt-3 pb-3">
        {{ $salas->links() }}
    </div>
@endsection
