<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PrincipalController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostController;

Route::get('/', function () {
    return view('welcome');
})->name('vista_inicio');

Route::get('/contact', function(){
    $nombre = "Esmeralda Palomino";
    return view('contact', ['nombre'=>$nombre, 'carrera'=>'LATI']);
})->name('contact');

Route::get('/principal', function(){
    $datos = ["titulo"=>"Tienda Virtual - Vista Principal",
    "mensaje"=>"Bienvenido a la vista principal"];
    return view('principal', $datos);
})->name('principal');

Route::get('/empresa', [HomeController::class, 'empresa'])->name('empresa');