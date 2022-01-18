@extends('layouts.layout')

@section('titulo', 'Registrar reservacion')

@section('content')
    <h2 class="texto-blanco pt-5 pb-3">Registrar reservacion</h2>
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
    <form class="my-3" action="{{ route('reservaciones.store') }}" method="post">
        @method('post')
        @csrf
        <div class="card mt-4">
            <div class="card-body shadow">
                <div class="col">
                    <div class="mb-2">
                        <div class="mb-2">
                            <label for="user_id" class="form-label texto my-2">
                                <h4> <b>Usuario:</b> </h4>
                            </label>
                            <select name="user_id" class="form-control">
                                <option selected disabled value="">Seleccione...</option>
                                @foreach ($usuarios as $usuario)
                                    <option value="{{ $usuario->id }}"> {{ $usuario->name }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <div class="mb-2">
                            <label for="sala_id" class="form-label texto my-2">
                                <h4 class="texto">Sala:</h4>
                            </label>
                            <select name="sala_id" class="form-control">
                                <option selected disabled value="">Seleccione...</option>
                                @foreach ($salas as $sala)
                                    <option value="{{ $sala->id }}"> {{ $sala->nombre }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="mb-2">
                        <div class="mb-2">
                            <label for="silla_id" class="form-label texto my-2">
                                <h4 class="texto">Sillas:</h4>
                            </label>
                            <select name="silla_id" class="form-control">
                                <option selected disabled value="">Seleccione...</option>
                                @foreach ($sillas as $silla)
                                    <option value="{{ $silla->id }}"> {{ $silla->descripcion }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-5 pb-3">
            <button type="submit" class="btn btn-primary mb-4" onclick="return confirm('¿Desea agregar la silla?')">
                Guardar
            </button>
        </div>
    </form>
@endsection
