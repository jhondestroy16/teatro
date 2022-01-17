@extends('layouts.layout')
@section('titulo', 'Reservas')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 my-5">
                <div class="card">
                    <div class="card-header card-header-primary">
                        <div class="card-title">Reservas</div>
                    </div>
                    <!--body-->
                    <div class="card-body">
                        <div class="row">
                            <!--end card user-->
                            <div class="col-md-6 my-3">
                                <div class="card card-user">
                                    <div class="card-body">
                                        <p class="card-text">
                                        <div class="author">
                                            <h5 class="title mx-3 text-center"><b>Usuario:
                                                    {{ $user->name }}</b></h5>
                                            </a>
                                            <p class="description">
                                                <tr>
                                                    <td> <b>Nombre usuario: </b> {{ $reservacion->name }} <br></td>
                                                    <td> <b>Nombre sala: </b> {{ $reservacion->nombre }} <br></td>
                                                    <td> <b>Descripcion sala: </b>{{ $reservacion->descripcion }} <br></td>
                                                    <td> <b>Descripcion silla: </b>{{ $reservacion->descripcionSilla }}<br></td>
                                                </tr>
                                            </p>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!--end card user 2-->
                            <div class="col-md-6 my-3">
                                <div class="card card-user">
                                    <div class="card-body">
                                        <p class="card-text">
                                        <div class="author">
                                            <h5 class="title mx-3 text-center"><b>Datos adicionales</b></h5>
                                            </a>
                                            <p class="description">
                                                <b>Cantidad de reservas totales: </b> {{ $cantidadReservas }} <br>
                                            </p>
                                        </div>
                                        </p>
                                    </div>
                                </div>
                                <br>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div class="button-container">
                            <a href="{{ route('reservaciones.index') }}" class="btn btn-primary mt-3">Volver</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
