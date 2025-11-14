<?php

use App\Livewire\Bienes\Create as BienesCreate;
use App\Livewire\Bienes\FichaRegistro as BienesFichaRegistro;
use App\Livewire\Bienes\Index as BienesIndex;
use App\Livewire\Bienes\Update as BienesUpdate;
use App\Livewire\Detalles\Create as DetallesCreate;
use App\Livewire\Detalles\Index as DetallesIndex;
use App\Livewire\Detalles\Update as DetallesUpdate;
use App\Livewire\Directores\Create;
use App\Livewire\Directores\FichaRegistro;
use App\Livewire\Directores\Index;
use App\Livewire\Directores\Update;
use App\Livewire\Dres\Create as DresCreate;
use App\Livewire\Dres\Index as DresIndex;
use App\Livewire\Dres\Update as DresUpdate;
use App\Livewire\Instituciones\Create as InstitucionesCreate;
use App\Livewire\Instituciones\Index as InstitucionesIndex;
use App\Livewire\Instituciones\Update as InstitucionesUpdate;
use App\Livewire\Proveedores\Create as ProveedoresCreate;
use App\Livewire\Proveedores\Index as ProveedoresIndex;
use App\Livewire\Proveedores\Update as ProveedoresUpdate;
use App\Livewire\Servicios\Create as ServiciosCreate;
use App\Livewire\Servicios\Index as ServiciosIndex;
use App\Livewire\Servicios\Update as ServiciosUpdate;
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

// Proveedores Routes
Route::get('proveedores', ProveedoresIndex::class)->name('proveedores.index');
Route::get('proveedores/create', ProveedoresCreate::class)->name('proveedores.create');
Route::get('proveedores/{proveedor}/edit', ProveedoresUpdate::class)->name('proveedores.edit');

// Servicios Routes
Route::get('servicios', ServiciosIndex::class)->name('servicios.index');
Route::get('servicios/create', ServiciosCreate::class)->name('servicios.create');
Route::get('servicios/{servicio}/edit', ServiciosUpdate::class)->name('servicios.edit');

// Bienes Routes
Route::get('bienes', BienesIndex::class)->name('bienes.index');
Route::get('bienes/create', BienesCreate::class)->name('bienes.create');
Route::get('bienes/{bien}/edit', BienesUpdate::class)->name('bienes.edit');
Route::get('bienes/ficha', BienesFichaRegistro::class)->name('bienes.ficha');

//Detalles Routes
Route::get('detalles', DetallesIndex::class)->name('detalles.index');
Route::get('detalles/create', DetallesCreate::class)->name('detalles.create');
Route::get('detalles/{detalle}/edit', DetallesUpdate::class)->name('detalles.edit');

//DRE Routes
Route::get('dres', DresIndex::class)->name('dres.index');
Route::get('dres/create', DresCreate::class)->name('dres.create');
Route::get('dres/{dre}/edit', DresUpdate::class)->name('dres.edit');

Route::get('/directores/ficha', FichaRegistro::class)->name('directores.ficha');

require __DIR__.'/auth.php';
