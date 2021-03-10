<?php

use Illuminate\Support\Facades\Route;

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

// Auth::routes();

// Caso o projeto de frontend seja instalado na estrutura de arquivos 
// do projeto de backend, a rota abaixo vai resolver as uris do front.
Route::get('{any}', function () {
    return view('quasar');
})->where('any','.*');
