@extends('layouts.app')
@section('title', 'Graficos')
@section('content')




    <div class="container">

        <div class="abc-center">

            <div class="container">
                <div class="row">
                    <div class="col">
                        <canvas id="myChart" width="50" height="45"></canvas>
                    </div>
                    <div class="col">
                        @if (is_object($nomAlm))
                            <h1 class="display-6">ALMACÉN: {{ $nomAlm->nomalm }}</h1>
                        @elseif (is_string($nomAlm))
                            <h1 class="display-6">{{ $nomAlm }}</h1>
                        @endif
                    </div>

                </div>
            </div>



        </div>


    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>

    <script type="module">
        // Recibe el array 'datos' desde el controlador
        var datos = {!! json_encode($datos) !!};

        // Prepara los arrays para los días y las ventas
        var dias = [];
        var fechas = [];
        var totalVentas = [];

        // Itera sobre los datos y separa los valores
        for (var i = 0; i < datos.length; i++) {
            dias.push(datos[i].dia);
            fechas.push(datos[i].fecha); // Mantén el formato '2023-01-03'
            totalVentas.push(datos[i].total_ventas);
        }

        // Configura la gráfica con los nuevos datos
        var ctx = document.getElementById('myChart').getContext('2d');
        var graficaVentasPorDia = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: fechas,
                datasets: [{
                    label: 'Ventas por Día',
                    data: totalVentas,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)',
                        'rgba(217, 194, 255, 0.7)',
                        'rgba(255, 159, 64, 0.7)',
                        'rgba(128, 0, 0, 0.7)',
                        'rgba(0, 128, 0, 0.7)',
                        'rgba(0, 0, 128, 0.7)',
                        'rgba(255, 0, 255, 0.7)',
                        'rgba(0, 255, 255, 0.7)',
                        'rgba(255, 255, 0, 0.7)',
                        'rgba(128, 128, 128, 0.7)',
                        'rgba(0, 0, 0, 0.7)',
                        'rgba(128, 0, 128, 0.7)',
                        'rgba(0, 128, 128, 0.7)',
                        'rgba(0, 255, 0, 0.7)',
                        'rgba(255, 0, 0, 0.7)',
                        'rgba(0, 0, 255, 0.7)'
                    ],
                    borderWidth: 2
                }]
            }
        });
    </script>


@endsection
