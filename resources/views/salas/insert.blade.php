@extends('layouts.layout')

@section('titulo', 'Registrar sala')

@section('content')
    <h2 class="texto-blanco pt-5 pb-3">Registrar Sala</h2>
    @if ($errors->any())

        <div class="alert alert-danger">
            <div class="header">
                <strong>Ups...</strong>algo salio mal
            </div>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>

    @endif
    <form class="my-3" action="{{ route('salas.store') }}" method="post">
        @method('post')
        @csrf
        <div class="card mt-4">
            <div class="card-body shadow">
                <div class="col">
                    <div class="mb-2">
                        <div class="mb-2">
                            <label for="nombre" class="form-label texto my-2">
                                <h4> <b>Nombre de la sala:</b> </h4>
                            </label>
                            <input type="text" name="nombre" id="nombre" class="form-control"
                                placeholder="Nombre de la sala" value="{{ old('nombre') }}">
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <div class="mb-2">
                            <label for="nombre" class="form-label texto my-2">
                                <h4> <b>Descripcion de la sala:</b> </h4>
                            </label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control"
                                placeholder="Descripcion de la sala" value="{{ old('descripcion') }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-5 pb-3">
            <button type="submit" class="btn btn-primary mb-4" onclick="return confirm('¿Desea agregar la sala?')">
                Guardar
            </button>
        </div>
    </form>
@endsection
