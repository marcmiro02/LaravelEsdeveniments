<?php

use App\Http\Controllers\HistorialController;
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
use App\Http\Controllers\TipusSeientController;
use App\Http\Controllers\EsdevenimentsController;
use App\Http\Controllers\EntradesController;
use App\Http\Controllers\TipusEsdevenimentController;
use App\Http\Controllers\QrController;
use App\Http\Controllers\PdfController;
use App\Models\Esdeveniments;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\HorariController;
use App\Http\Controllers\SearchController;


//------------------------------------- INICI -------------------------------------//
Route::get('/', [EmpresesController::class, 'welcome'])->name('welcome');
// Route::get('/', function () {
//     $esdeveniments = Esdeveniments::all();
//     return view('inici', compact('esdeveniments'));
// })->name('inici');


// ================================
// =            CLIENT            =
// ================================

// -------------------------------
// -        ESDEVENIMENTS        -
// -------------------------------

// MOSTRAR ESDEVENIMENTS

// Route::get('/', function () {
//     $esdeveniments = Esdeveniments::all();
//     return view('inici', compact('esdeveniments'));
// })->name('inici');

// ------------------------------
// -          ENTRADES          -
// ------------------------------

// TRIAR SEIENTS

// INICIAR SESSIÓ

// TRIAR ENTRADES

// RESUM DE LA COMPRA

// PAGAMENT

// CONFIRMACIÓ DE LA COMPRA

// CREACIÓ DE LA ENTRADA QR

// ENVIAMENT PER CORREU




// ================================
// =           EMPRESES           =
// ================================

// REDIRECCIO PAGINA WELCOME A PAGINA ESDEVENIMENTS DE CADA EMPRESA
Route::get('/inici', [EsdevenimentsController::class, 'index'])->name('inici');
// PODER UTILITZAR LES DADES DE LEMPRESA QUAN L'HAS SELECCIONAT AL WELCOME.BLADE
Route::get('/inici/{id_empresa}', [EmpresesController::class, 'inici'])->name('inici');
// ------------------------------
// -          USUARIS           -
// ------------------------------

// MOSTRAR USUARIS

// MOSTRAR USUARI

// CREAR USUARI

// MODIFICAR USUARI

// ELIMINAR


// -------------------------------
// -            SALES            -
// -------------------------------

// MOSTRAR SALES

// MOSTRAR SALA

// CREAR SALA

// MODIFICAR SALA

// ELIMINAR SALA


// -------------------------------
// -        ESDEVENIMENTS        -
// -------------------------------

// MOSTRAR ESDEVENIMENTS

Route::get('/esdeveniments', [EsdevenimentsController::class, 'index'])->name('esdeveniments.index');

// MOSTRAR ESDEVENIMENT

// CREAR ESDEVENIMENT

// MODIFICAR ESDEVENIMENT

// ELIMINAR ESDEVENIMENT

Route::get('/horaris', [HorariController::class, 'index'])->name('horaris.index');
Route::get('/horaris/empresa', [HorariController::class, 'indexEmpresa'])->name('horaris.indexEmpresa');
Route::get('/horaris/{id_esdeveniment}', [HorariController::class, 'show'])->name('horaris.show');
Route::post('/horaris/{id_esdeveniment}', [HorariController::class, 'store'])->name('horaris.store');
Route::put('/horaris/{id_horari}', [HorariController::class, 'update'])->name('horaris.update');
Route::delete('/horaris/{id_horari}', [HorariController::class, 'destroy'])->name('horaris.destroy');

// --------------------------------
// -      CODIS PROMOCIONALS      -
// --------------------------------

// MOSTRAR CODIS PROMOCIONALS

// MOSTRAR CODI PROMOCIONAL

// CREAR CODI PROMOCIONAL

// MODIFICAR CODI PROMOCIONAL

// ELIMINAR CODI PROMOCIONAL


// ------------------------------
// -            QR              -
// ------------------------------

// VALIDAR QR




// ================================
// =            ADMINS            =
// ================================

// -------------------------------
// -         CATEGORIES          -
// -------------------------------

// MOSTRAR CATEGORIES

// MOSTRAR CATEGORIA

// CREAR CATEGORIA

// MODIFICAR CATEGORIA

// ELIMINAR CATEGORIA


// --------------------------------
// -      CODIS PROMOCIONALS      -
// --------------------------------

// MOSTRAR CODIS PROMOCIONALS

// MOSTRAR CODI PROMOCIONAL

// CREAR CODI PROMOCIONAL

// MODIFICAR CODI PROMOCIONAL

// ELIMINAR CODI PROMOCIONAL


// ------------------------------
// -          USUARIS           -
// ------------------------------

// MOSTRAR USUARIS

// MOSTRAR USUARI

// CREAR USUARI

// MODIFICAR USUARI

// ELIMINAR USUARI


// -------------------------------
// -            ROLS             -
// -------------------------------

// MOSTRAR ROLS

// MOSTRAR ROL

// CREAR ROL

// MODIFICAR ROL

// ELIMINAR ROL


// ------------------------------
// -          EMPRESES          -
// ------------------------------

// MOSTRAR EMPRESES

// MOSTRAR EMPRESA

// CREAR EMPRESA

// MODIFICAR EMPRESA

// ELIMINAR EMPRESA


// ------------------------------
// -          ENTRADES          -
// ------------------------------

// MOSTRAR ENTRADES

// MOSTRAR ENTRADA

// CREAR ENTRADA

// MODIFICAR ENTRADA

// ELIMINAR ENTRADA


// -------------------------------
// -        ESDEVENIMENTS        -
// -------------------------------

// MOSTRAR ESDEVENIMENTS

Route::get('/esdeveniments', [EsdevenimentsController::class, 'index'])->name('esdeveniments.index');

// MOSTRAR ESDEVENIMENT

// CREAR ESDEVENIMENT

// MODIFICAR ESDEVENIMENT

// ELIMINAR ESDEVENIMENT


// -------------------------------
// -        ESTAT SEIENTS        -
// -------------------------------

// MOSTRAR ESTATS SEIENTS

// MOSTRAR ESTAT SEIENT

// CREAR ESTAT SEIENT

// MODIFICAR ESTAT SEIENT

// ELIMINAR ESTAT SEIENT


// ------------------------------
// -            QR              -
// ------------------------------

// MOSTRAR QRS

// MOSTRAR QR

// CREAR QR

// MODIFICAR QR

// ELIMINAR QR


// ------------------------------
// -           SALES            -
// ------------------------------

// MOSTRAR SALES

// MOSTRAR SALA

// CREAR SALA

// MODIFICAR SALA

// ELIMINAR SALA


// -------------------------------
// -     TIPUS ESDEVENIMENTS     -
// -------------------------------

// MOSTRAR TIPUS ESDEVENIMENTS

// MOSTRAR TIPUS ESDEVENIMENT

// CREAR TIPUS ESDEVENIMENT

// MODIFICAR TIPUS ESDEVENIMENT

// ELIMINAR TIPUS ESDEVENIMENT


// -------------------------------
// -       TIPUS SEIENTS         -
// -------------------------------

// MOSTRAR TIPUS SEIENTS

// MOSTRAR TIPUS SEIENT

// CREAR TIPUS SEIENT

// MODIFICAR TIPUS SEIENT

// ELIMINAR TIPUS SEIENT


// ================================
// =            ALTRES            =
// ================================

// MOSTRAR HISTORIAL EVENTS USUARI
Route::resource('historial', HistorialController::class)->middleware(['auth', 'verified']);
Route::get('/historial', [HistorialController::class, 'index'])->name('historial.index');
Route::get('/pdf/{id}/show', [PdfController::class, 'show'])->name('pdf.show');
Route::get('/pdf/{id}/download', [PdfController::class, 'download'])->name('pdf.download');

// BARRA DE BUSQUEDA
//Route::get('/esdeveniments/search-live', [EsdevenimentsController::class, 'liveSearch'])->name('esdeveniments.live-search');

// ------------------------------
// -           ALTRES           -
// ------------------------------
Route::get('/esdeveniments/{id_esdeveniment}/horaris/mostracio', [HorariController::class, 'mostracio'])->name('horaris.mostracio');

// BARRA DE BUSQUEDA
Route::get('/search', [SearchController::class, 'search'])->name('search');



// 
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




Route::get('pdf', [PdfController::class, 'showEventSelection'])->name('pdf.index');


Route::post('/pdf/generarEntrada', [PdfController::class, 'generarEntrada'])->name('pdf.generarEntrada');




Route::get('/pdf/validarEntrada', [PdfController::class, 'indexValidar'])->name('pdf.indexValidar');
Route::post('/pdf/validarEntrada', [PdfController::class, 'pestanyaValidar'])->name('pdf.validarEntrada');
Route::post('/pdf/validarQr', [QrController::class, 'validarQr'])->name('pdf.validarQr');





Route::get('/sales/{id_sala}/seients', [SeientsController::class, 'showSeients'])->name('sales.seients')->middleware(['auth', 'verified']);
Route::get('/sales/{id_sala}/seients', [SeientsController::class, 'showSeients'])->name('sales.seients')->middleware(['auth', 'verified']);




Route::get('/tickets/select-entrades', [TicketController::class, 'showSelectEntrades'])->name('tickets.selectEntrades');
Route::get('/tickets/order-summary', [TicketController::class, 'showOrderSummary'])->name('tickets.orderSummary');
Route::post('/tickets/process-payment', [TicketController::class, 'processPayment'])->name('tickets.processPayment');
Route::get('/tickets/success', [TicketController::class, 'success'])->name('tickets.success');
Route::get('/tickets/cancel', [TicketController::class, 'cancel'])->name('tickets.cancel');

require __DIR__ . '/auth.php';