<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Almacen;
use App\Models\Agente;
use App\Models\Pago;
use League\Csv\Reader;


class AnalisisController extends Controller
{

    public function home()
    {

        return view('index');
    }

    public function analisisPastelIndex()
    {
        $almacen = Almacen::all();
        return view('analisis.pastel.index', ['almacen' => $almacen]);
    }


    public function analisisLineasIndex()
    {
        $almacen = Almacen::all();
        return view('analisis.lineas.index', ['almacen' => $almacen]);
    }



    public function importarAgentesCSV()
    {
        $csvPath = storage_path('csv/agentesCSV.csv');
        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0);

        $registros = $csv->getRecords();

        foreach ($registros as $registro) {
            // Acceder a los datos del registro
            $id = $registro['id'];
            $numagt = $registro['numagt'];
            $nomagt = $registro['nomagt'];

            Agente::create(['id' => $id, 'numagt' => $numagt, 'nomagt' => $nomagt]);
        }
    }

    public function importarAlmacenCSV()
    {
        $csvPath = storage_path('csv/almacenCSV.csv');
        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0);

        $registros = $csv->getRecords();

        foreach ($registros as $registro) {
            // Acceder a los datos del registro
            $id = $registro['id'];
            $numalm = $registro['numalm'];
            $nomalm = $registro['nomalm'];

            Almacen::create(['id' => $id, 'numalm' => $numalm, 'nomalm' => $nomalm]);
        }

        return redirect()->back();
    }

    public function importarPagosCSV()
    {
        $csvPath = storage_path('csv/pagosCSV.csv');
        $csv = Reader::createFromPath($csvPath, 'r');
        $csv->setHeaderOffset(0);

        $registros = $csv->getRecords();

        foreach ($registros as $registro) {

            $folio = $registro['folio'];
            $fpago = $registro['fpago'];
            $almacen_id = $registro['almacen'];
            $fecha = $registro['fechatt'];
            $cliente = $registro['cliente'];
            $importe = $registro['importe'];
            $serie = $registro['serie'];
            $hora = $registro['hora'];
            $agente = $registro['agente'];
            $sucursal = $registro['sucursal'];
            $id = $registro['id'] -1;

            $pago = new Pago();

            if($agente==0){

                $pago->id = $id;
                $pago->fpago = $fpago;
                $pago->fecha = $fecha;
                $pago->cliente = $cliente;
                $pago->importe = $importe;
                $pago->serie = $serie;
                $pago->hora = $hora;
                $pago->agt_id = 1;
                $pago->almacen_id = $almacen_id;
                $pago->sucursal = $sucursal;
                $pago->save();

            }else{

                $pago->id = $id;
                $pago->fpago = $fpago;
                $pago->fecha = $fecha;
                $pago->cliente = $cliente;
                $pago->importe = $importe;
                $pago->serie = $serie;
                $pago->hora = $hora;
                $pago->agt_id = $agente;
                $pago->almacen_id = $almacen_id;
                $pago->sucursal = $sucursal;
                $pago->save();

            }

        }

        return redirect()->back();
    }
}
