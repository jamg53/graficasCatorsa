<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AnalisisController;
use App\Http\Controllers\VentasController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',[AnalisisController::class, 'home'])->name('home');

Route::get('/catorsa/datos',[AnalisisController::class, 'index'])->name('analisis.index');

Route::get('/importar-cvs/agente',[AnalisisController::class, 'importarAgentesCSV'])->name('importarAgentes.cvs');

Route::get('/importar-cvs/almacen',[AnalisisController::class, 'importarAlmacenCSV'])->name('importarAlmacen.cvs');

Route::get('/importar-cvs/pagos',[AnalisisController::class, 'importarPagosCSV'])->name('importarPagos.cvs');

Route::get('/catorsa/analisis',[VentasController::class, 'formCheck'])->name('analisis.show');


