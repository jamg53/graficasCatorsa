<?php

namespace App\Http\Controllers;

use App\Models\Pago;
use App\Models\Almacen;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{

    // ESTE METODO SE ENCARGA DE VALIDAR LAS OPCIONES QUE EL USUARIO NECESITA Y SELECCIONO
    public function formCheck(Request $request)
    {

        $instancia = new VentasController();
        //SI EL UN REPORTE POR TODOS LOS ALMACENES
        if ($request->has('Check1')) {
            //SI ES DE TODOS LOS REGISTROS SIN IMPORTAR LAS FECHAS
            if ($request->has('Check2')) {

                $ventasPorDia = Pago::select(DB::raw('DAY(fecha) as dia, fecha, COUNT(*) as total_ventas'))
                    ->groupBy(DB::raw('DAY(fecha)'), 'fecha')
                    ->get();

                $nomAlm = 'Todos los almacenes';

                $datos = [];
                foreach ($ventasPorDia as $ventaPorDia) {
                    $datos[] = [
                        'dia' => $ventaPorDia->dia,
                        'fecha' => $ventaPorDia->fecha,
                        'total_ventas' => $ventaPorDia->total_ventas
                    ];
                }

                return view('analisis.show', ['nomAlm' => $nomAlm, 'datos' => $datos]);
            }
            //SI ES SOLO POR INTERVALOS DE FECHAS
            else {
                //SI ES POR HORAS ESPECIFICAS
                if ($request->has('Check3')) {
                }
                //SIN IMPORTAR LAS HORAS
                else {
                    $request->validate([
                        'fechaInicio' => 'required',
                        'fechaFinal' => 'required'
                    ]);

                    $fechaInicio = $request->input('fechaInicio');
                    $fechaFinal  = $request->input('fechaFinal');

                    $ventasPorDia = Pago::select(DB::raw('DAY(fecha) as dia, fecha, COUNT(*) as total_ventas'))
                        ->whereBetween('fecha', [$fechaInicio, $fechaFinal])
                        ->groupBy(DB::raw('DAY(fecha)'), 'fecha')
                        ->get();

                    $nomAlm = 'Todos los almacenes';

                    $datos = [];
                    foreach ($ventasPorDia as $ventaPorDia) {
                        $datos[] = [
                            'dia' => $ventaPorDia->dia,
                            'fecha' => $ventaPorDia->fecha,
                            'total_ventas' => $ventaPorDia->total_ventas
                        ];
                    }

                    return view('analisis.show', ['nomAlm' => $nomAlm, 'datos' => $datos]);
                }
            }
        }

        //SI ES SOLO UN ALMACEN ES ESPECIFICO
        else {
            //SI ES DE TODOS LOS REGISTROS SIN IMPORTAR LAS FECHAS
            if ($request->has('Check2')) {

                $request->validate([
                    'selectAlmacen' => 'required'
                ]);

                $almacenId = $request->input('selectAlmacen');

                $nomAlm = Almacen::find($almacenId);

                $ventasPorDia = Pago::select(DB::raw('DAY(fecha) as dia, fecha, COUNT(*) as total_ventas'))
                    ->where('almacen_id', $almacenId)
                    ->groupBy(DB::raw('DAY(fecha)'), 'fecha')
                    ->get();

                $datos = [];
                foreach ($ventasPorDia as $ventaPorDia) {
                    $datos[] = [
                        'dia' => $ventaPorDia->dia,
                        'fecha' => $ventaPorDia->fecha,
                        'total_ventas' => $ventaPorDia->total_ventas
                    ];
                }

                return view('analisis.show', ['nomAlm' => $nomAlm, 'datos' => $datos]);
            }
            //SI ES SOLO POR INTERVALOS DE FECHAS
            else {
                //SI ES POR HORAS ESPECIFICAS
                if ($request->has('Check3')) {
                }
                //SIN IMPORTAR LAS HORAS
                else {

                    $request->validate([
                        'fechaInicio' => 'required',
                        'fechaFinal' => 'required',
                        'selectAlmacen' => 'required'
                    ]);

                    $fechaInicio = $request->input('fechaInicio');
                    $fechaFinal  = $request->input('fechaFinal');
                    $almacenId = $request->input('selectAlmacen');

                    $nomAlm = Almacen::find($almacenId);

                    $ventasPorDia = Pago::select(DB::raw('DAY(fecha) as dia, fecha, COUNT(*) as total_ventas'))
                        ->where('almacen_id', $almacenId)
                        ->whereBetween('fecha', [$fechaInicio, $fechaFinal])
                        ->groupBy(DB::raw('DAY(fecha)'), 'fecha')
                        ->get();

                    $datos = [];
                    foreach ($ventasPorDia as $ventaPorDia) {
                        $datos[] = [
                            'dia' => $ventaPorDia->dia,
                            'fecha' => $ventaPorDia->fecha,
                            'total_ventas' => $ventaPorDia->total_ventas
                        ];
                    }

                    return view('analisis.show', ['nomAlm' => $nomAlm, 'datos' => $datos]);
                }
            }
        }
    }

    public function ventasDiaMesTodosAlmacenes(Request $request)
    {

        $request->validate([
            'fechaInicio' => 'required',
            'fechaFinal' => 'required'
        ]);

        $fechaInicio = $request->input('fechaInicio');
        $fechaFinal  = $request->input('fechaFinal');

        $ventasPorDia = Pago::select(DB::raw('DAY(fecha) as dia, COUNT(*) as total_ventas'))
            ->whereBetween('fecha', [$fechaInicio, $fechaFinal])
            ->groupBy(DB::raw('DAY(fecha)'))
            ->get();

        $dias = $ventasPorDia->pluck('dia');
        $totalVentas = $ventasPorDia->pluck('total_ventas');

        return view('analisis.show', ['dias' => $dias, 'totalVentas' => $totalVentas]);
    }

    public function ventasDiaMesPorAlmacen(Request $request)
    {

        $request->validate([
            'fechaInicio' => 'required',
            'fechaFinal' => 'required',
            'selectAlmacen' => 'required'
        ]);

        $fechaInicio = $request->input('fechaInicio');
        $fechaFinal  = $request->input('fechaFinal');
        $almacenId = $request->input('selectAlmacen');

        $ventasPorDia = Pago::select(DB::raw('DAY(fecha) as dia, COUNT(*) as total_ventas'))
            ->where('almacen_id', $almacenId)
            ->whereBetween('fecha', [$fechaInicio, $fechaFinal])
            ->groupBy(DB::raw('DAY(fecha)'))
            ->get();

        $dias = $ventasPorDia->pluck('dia');
        $totalVentas = $ventasPorDia->pluck('total_ventas');

        return view('analisis.show', ['dias' => $dias, 'totalVentas' => $totalVentas]);
    }
}
