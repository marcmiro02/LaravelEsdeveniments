<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpresesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SalesController;
<<<<<<< HEAD
use App\Http\Controllers\SeientsController;
=======
use App\Http\Controllers\UsersController;
>>>>>>> 522be8b6bc1238fac2be2ef1428822afe415f9ba


Route::get('/', function () {
    return view('welcome');
});


//------------------------------------- DASHBOARD -------------------------------------//
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


//--------------------------------------- USERS ---------------------------------------//
Route::resource('users', UsersController::class)->parameters([
   'users' => 'id_usuari'
])->middleware(['auth', 'verified']);


//-------------------------------------- EMPRESES --------------------------------------//
Route::resource('empreses', EmpresesController::class)->parameters([
    'empreses' => 'id_empresa'
])->middleware(['auth', 'verified']);


//----------------------------------- ESDEVENIMENTS -----------------------------------//
//Route::resource('esdeveniments', EsdevenimentsController::class)->parameters([
//    'esdeveniments' => 'id_esdeveniment'
//])->middleware(['auth', 'verified']);


//------------------------------------- CATEGORIES -------------------------------------//
Route::resource('categories', CategoriesController::class)->parameters([
    'categories' => 'id_categoria'
])->middleware(['auth', 'verified']);


//------------------------------------ ESTAT_SEIENTS ------------------------------------//
//Route::resource('estat_seients', EstatSeientsController::class)->parameters([
//    'estat_seients' => 'id_estat_seient'
//])->middleware(['auth', 'verified']);


//-------------------------------------- TIPUS_SEIENTS --------------------------------------//
//Route::resource('tipus_seients', TipusSeientsController::class)->parameters([
//    'tipus_seients' => 'id_tipus_seient'
//])->middleware(['auth', 'verified']);

//-------------------------------------- SEIENTS --------------------------------------//
Route::resource('seients', SeientsController::class)->parameters([
    'seients' => 'id_seient'
])->middleware(['auth', 'verified']);


//---------------------------------------- qr ----------------------------------------//
//Route::resource('qr', QrController::class)->parameters([
//    'qr' => 'id_qr'
//])->middleware(['auth', 'verified']);


//------------------------------------ ROLS_USUARIS ------------------------------------//
//Route::resource('rols_usuaris', RolsUsuarisController::class)->parameters([
//    'rols_usuaris' => 'id_rol'
//])->middleware(['auth', 'verified']);


//------------------------------------ SALES ------------------------------------//
Route::resource('sales', SalesController::class)->parameters([
    'sales' => 'id_sala'
])->middleware(['auth', 'verified']);


//------------------------------------ TIPUS_ESDEVENIMENTS ------------------------------------//
//Route::resource('tipus_esdeveniments', TipusEsdevenimentsController::class)->parameters([
//    'tipus_esdeveniments' => 'id_tipus'
//])->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
