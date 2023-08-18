@extends('layouts.app')
@section('title', 'Pastel')
@section('content')

    @vite(['resources/js/form-check-pastel.js'])
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery-timepicker/jquery.timepicker.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">


    <div class="container">

        <div class="adc-center">

            <form action="{{ route('analisis.pastel.show') }}" method="GET" id="myForm">

                <div class="row">

                    <div class="container">

                        <h3>
                            <small class="text-muted">Grafica de pastel</small>
                        </h3>

                        <div class="row">
                            <div class="col">

                                <div class="form-floating">
                                    <select class="form-select form-select-sm" aria-label=".form-select-sm example"
                                        id="selectAlmacen" name="selectAlmacen">
                                        @foreach ($almacen as $almacenes)
                                            <option value="{{ $almacenes->id }}">{{ $almacenes->nomalm }}</option>
                                        @endforeach
                                    </select>
                                    <label for="selectAlmacen">Almacén</label>
                                </div>


                            </div>
                            <div class="col">
                                <br>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="Check1" name="Check1">
                                    <label class="form-check-label" for="Check1">Todos los almacenes</label>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col">
                                <label>Intervalo de dias</label>
                                <br>
                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">De</span>
                                    <input type="text" class="form-control" name="fechaInicio" id="fechaIncio"
                                        name="fechaIncio" placeholder="Inicio" aria-label="Username"
                                        aria-describedby="basic-addon1" readonly>
                                </div>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon">A</span>
                                    <input type="text" class="form-control" name="fechaFinal" id="fechaFinal"
                                        name="fechaFinal" placeholder="Final" aria-label="Username"
                                        aria-describedby="basic-addon1" readonly>
                                </div>


                            </div>
                            <div class="col">
                                <br>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="Check2" name="Check2">
                                    <label class="form-check-label" for="Check2">Totalizar dias</label>
                                </div>
                                <br>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="Check2hoy" name="Check2Hoy">
                                    <label class="form-check-label" for="Check2">Hasta hoy</label>
                                </div>
                            </div>
                            <div class="w-100"></div>
                            <div class="col">

                                <label>Intervalo de horas</label>
                                <br>

                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">De</span>
                                    <input type="text" class="form-control" name="horaInicio" id="horaInicio"
                                        name="horaInicio" placeholder="Final" aria-label="Username"
                                        aria-describedby="basic-addon1" readonly disabled>
                                </div>


                                <div class="input-group mb-3">
                                    <span class="input-group-text" id="basic-addon1">A</span>
                                    <input type="text" class="form-control" name="horaFinal" id="horaFinal"
                                        name="horaFinal" placeholder="Final" aria-label="Username"
                                        aria-describedby="basic-addon1" readonly disabled>
                                </div>
                            </div>

                            <div class="col">
                                <br>
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="Check3" name="Check3">
                                    <label class="form-check-label" for="Check3">Por intervalo de horas</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="d-grid gap-2">
                    <br>
                    <button id="buttonGenerarAnalisis" class="btn btn-primary" type="submit">Generar</button>
                </div>
            </form>


        </div>
    </div>



@endsection
