@extends('layouts.layout')

@section('titulo', 'Salas')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 my-5">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="card-title">Salas</div>
                        <p class="card-category">Vista detallada de la sala: <b>{{ $sala->nombre }}
                        </p>
                    </div>
                    <!--body-->
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-7 my-3">
                                <div class="card card-user">
                                    <div class="card-body">
                                        <p class="card-text">
                                        <div class="author">
                                            <h5 class="title mx-3 text-center"><b>Sala:</b></h5>
                                            <p class="description text-center">
                                                <b>Nombre de la sala: </b> {{ $sala->nombre }} <br>
                                                <b>Descripcion de la sala: </b> {{ $sala->descripcion }} <br>
                                            </p>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--end card user-->
                            <div class="col-md-5 my-3">
                                <div class="card card-user">
                                    <div class="card-body">
                                        <p class="card-text">
                                        <div class="author">
                                            <h5 class="title mx-3 text-center"><b>Sillas</b></h5>
                                            <p class="description">
                                                @foreach ($sillas as $silla)
                                                    <tr>
                                                        <td><b>Nombre de la sala: </b>{{ $silla->nombre }}<br></td>
                                                        <td><b>Descripcion de la silla: </b>{{ $silla->descripcionSilla }}<br></td><br>
                                                    </tr>
                                                @endforeach
                                            </p>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--end card user 2-->
                            Cantidad total de salas: {{ $cantidadTotal }}
                        </div>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="button-container">
                        <a href="{{ route('salas.index') }}" class="btn btn-primary mt-3">Volver</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
