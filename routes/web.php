<?php

use App\Livewire\Directores\Create;
use App\Livewire\Directores\Index;
use App\Livewire\Directores\Update;
use App\Livewire\Instituciones\Create as InstitucionesCreate;
use App\Livewire\Instituciones\Index as InstitucionesIndex;
use App\Livewire\Instituciones\Update as InstitucionesUpdate;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});

// Directores Routes
Route::get('directores', Index::class)->name('directores.index');
Route::get('directores/create', Create::class)->name('directores.create');
Route::get('directores/{director}/edit', Update::class)->name('directores.edit');

// Instituciones Routes
Route::get('instituciones', InstitucionesIndex::class)->name('instituciones.index');
Route::get('instituciones/create', InstitucionesCreate::class)->name('instituciones.create');
Route::get('instituciones/{institucion}/edit', InstitucionesUpdate::class)->name('instituciones.edit');


require __DIR__.'/auth.php';
