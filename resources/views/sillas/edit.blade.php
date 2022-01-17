@extends('layouts.layout')

@section('titulo', 'Registrar silla')

@section('content')
    <h2 class="texto-blanco pt-5 pb-3">Registrar Silla</h2>
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
    <form class="my-3" action="{{ route('sillas.update', $silla->id) }}" method="post">
        @method('post')
        @csrf
        <div class="card mt-4">
            <div class="card-body shadow">
                <div class="col">
                    <div class="mb-2">
                        <div class="mb-2">
                            <label for="nombre" class="form-label texto my-2">
                                <h4> <b>Descripcion de la silla:</b> </h4>
                            </label>
                            <input type="text" name="descripcion" id="descripcion" class="form-control" placeholder="Descripcion de la silla"
                            value="{{ $silla->descripcion }}">
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
            </div>
        </div>
        <div class="pt-5 pb-3">
            <button type="submit" class="btn btn-primary mb-4" onclick="return confirm('¿Desea modificar la silla?')">
                Guardar
            </button>
        </div>
    </form>
@endsection
