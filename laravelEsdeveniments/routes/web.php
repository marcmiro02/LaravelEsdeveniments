<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\EmpresesController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\SeientsController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\RolsUsuarisController;
use App\Http\Controllers\EstatSeientsController;
use App\Http\Controllers\CodisPromocionalsController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\TipusSeientController;
use App\Http\Controllers\EsdevenimentsController;
use App\Http\Controllers\EntradesController;
use App\Http\Controllers\TipusEsdevenimentController;
use App\Http\Controllers\QrController;
use App\Models\Esdeveniments;




//------------------------------------- DASHBOARD -------------------------------------//
Route::get('/', function () {
    $esdeveniments = Esdeveniments::all();
    return view('welcome', compact('esdeveniments'));
})->name('welcome');

//--------------------------------------- USERS ---------------------------------------//
Route::resource('users', UsersController::class)->middleware(['auth', 'verified']);


//-------------------------------------- EMPRESES --------------------------------------//
Route::resource('empreses', EmpresesController::class)->parameters([
    'empreses' => 'id_empresa'
])->middleware(['auth', 'verified']);


//----------------------------------- ESDEVENIMENTS -----------------------------------//
Route::resource('esdeveniments', EsdevenimentsController::class)->parameters([
    'esdeveniments' => 'id_esdeveniment'
])->middleware(['auth', 'verified']);


//------------------------------------- CATEGORIES -------------------------------------//
Route::resource('categories', CategoriesController::class)->parameters([
    'categories' => 'id_categoria'
])->middleware(['auth', 'verified']);


//------------------------------------ ESTAT_SEIENTS ------------------------------------//
Route::resource('estat_seients', EstatSeientsController::class)->parameters([
    'estat_seients' => 'id_estat_seient'
])->middleware(['auth', 'verified']);


//-------------------------------------- TIPUS_SEIENTS --------------------------------------//
Route::resource('tipus_seients', TipusSeientController::class)->parameters([
    'tipus_seients' => 'id_tipus_seient'
])->middleware(['auth', 'verified']);


//-------------------------------------- SEIENTS --------------------------------------//
Route::resource('seients', SeientsController::class)->parameters([
    'seients' => 'id_seient'
])->middleware(['auth', 'verified']);


//---------------------------------------- qr ----------------------------------------//
Route::resource('qrs', QrController::class)->parameters([
    'qr' => 'id_qr'
])->middleware(['auth', 'verified']);


//------------------------------------ ROLS_USUARIS ------------------------------------//
Route::resource('rols_usuaris', RolsUsuarisController::class)->parameters([
    'rols_usuaris' => 'id_rol'
])->middleware(['auth', 'verified']);


//------------------------------------ SALES ------------------------------------//
Route::resource('sales', SalesController::class)->parameters([
    'sales' => 'id_sala'
])->middleware(['auth', 'verified']);


//------------------------------------ TIPUS_ESDEVENIMENTS ------------------------------------//
Route::resource('tipus_esdeveniments', TipusEsdevenimentController::class)->parameters([
    'tipus_esdeveniments' => 'id_tipus'
])->middleware(['auth', 'verified']);


//------------------------------------ CODIS PROMOCIONALS ------------------------------------//
Route::resource('codis_promocionals', CodisPromocionalsController::class)->parameters([
    'codis_promocionals' => 'id_codi'
])->middleware(['auth', 'verified']);


//------------------------------------ ENTRADES ------------------------------------//
Route::resource('entrades', EntradesController::class)->parameters([
    'entrades' => 'id_entrada'
])->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
