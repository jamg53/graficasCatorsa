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
                    Column
                  </div>

                </div>
              </div>



        </div>


    </div>

    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.8.0/chart.min.js"></script>

    <script type="module">
        // Configura los datos para la gráfica
        var ctx = document.getElementById('myChart').getContext('2d');
        var dias = {!! json_encode($dias) !!};
        var totalVentas = {!! json_encode($totalVentas) !!};

        console.log(dias);
        console.log(totalVentas);

        // Crea la gráfica de pastel
        var graficaVentasPorDia = new Chart(ctx, {
            type: 'pie',
            data: {
                labels: dias,
                datasets: [{
                    label: 'Ventas por Día',
                    data: totalVentas,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.7)',
                        'rgba(54, 162, 235, 0.7)',
                        'rgba(255, 206, 86, 0.7)',
                        'rgba(75, 192, 192, 0.7)',
                        'rgba(153, 102, 255, 0.7)'
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>


@endsection
