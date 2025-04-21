<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\CargarPersonajes::class)->name('home');

Route::get('editar/{id}', \App\Livewire\EditarPersonajes::class)->name('editar-personaje');

Route::get('api-personajes', \App\Livewire\ApiPersonajes::class)->name('api-personajes');