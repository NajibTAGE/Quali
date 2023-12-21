<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\adminController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register' => false]);

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home')->middleware('moderateur');
Route::get('/correcteur', [App\Http\Controllers\correcteurController::class, 'index'])->name('correcteur')->middleware('client');
Route::get('/admin', [App\Http\Controllers\adminController::class, 'index'])->name('admin')->middleware('moderateur');
Route::delete('/admin/{user}', [App\Http\Controllers\adminController::class, 'destroy'])->name('admin.destroy')->middleware('moderateur');
Route::get('/admin/create', [App\Http\Controllers\adminController::class, 'create'])->name('admin.create')->middleware('moderateur');
Route::post('/admin', [App\Http\Controllers\adminController::class, 'store'])->name('admin.store')->middleware('moderateur');
Route::get('/admin/{user}/edit', [App\Http\Controllers\adminController::class, 'edit'])->name('admin.edit')->middleware('moderateur');
Route::put('/admin/{user}', [App\Http\Controllers\adminController::class, 'update'])->name('admin.update')->middleware('moderateur');
Route::get('/rapporta', [App\Http\Controllers\rapportaController::class, 'index'])->name('rapporta')->middleware('moderateur');
Route::get('/rapporta/create', [App\Http\Controllers\rapportaController::class, 'create'])->name('rapporta.create')->middleware('moderateur');
Route::post('/rapporta', [App\Http\Controllers\rapportaController::class, 'store'])->name('rapporta.store')->middleware('moderateur');
Route::get('/rapporta/{id}/edit', [App\Http\Controllers\rapportaController::class, 'edit'])->name('rapporta.edit')->middleware('moderateur');
Route::put('/rapporta/{rapporta}', [App\Http\Controllers\rapportaController::class, 'update'])->name('rapporta.update')->middleware('moderateur');
Route::delete('/rapporta/{id}', [App\Http\Controllers\rapportaController::class, 'destroy'])->name('rapporta.destroy')->middleware('moderateur');
Route::put('/correcteur/{correcteur}', [App\Http\Controllers\correcteurController::class, 'update'])->name('correcteur.update')->middleware('client');
Route::get('/historique', [App\Http\Controllers\historiquecontroller::class, 'index'])->name('historique');
Route::get('telecharger-fichier/{id}', [App\Http\Controllers\correcteurController::class, 'telechargerFichier'])->name('telecharger.fichier');
Route::post('telecharger-fichier/{id}', [App\Http\Controllers\correcteurController::class, 'ajouterFichier'])->name('ajouter.fichier');
Route::post('/generate-pdf', [App\Http\Controllers\PDFController::class, 'generatePDF'])->name('generatePDF');
Route::post('/export-excel', [App\Http\Controllers\ExportController::class, 'exportToExcel'])->name('export.excel');
Route::post('/import', [App\Http\Controllers\ImportController::class, 'importExcel'])->name('importExcel');
Route::get('/historiqueM', [App\Http\Controllers\HistoriqueMController::class, 'index'])->name('historiqueM');
Route::get('/get-rapporta-details/{id}', [App\Http\Controllers\rapportaController::class, 'getRapportaDetails'])->name('getRapportaDetails');
Route::get('/detail/{client}', [App\Http\Controllers\detailController::class, 'show'])->name('detail')->middleware('moderateur');
Route::post('/accept/{id}', [App\Http\Controllers\correcteurController::class, 'accept'])->name('accept')->middleware('client');
Route::post('/traiter/{id}', [App\Http\Controllers\correcteurController::class, 'traiter'])->name('traiter')->middleware('client');
Route::post('/rejeter/{id}', [App\Http\Controllers\correcteurController::class, 'rejeter'])->name('rejeter')->middleware('client');
Route::post('/cloturer/{id}', [App\Http\Controllers\rapportaController::class, 'cloturer'])->name('cloturer')->middleware('moderateur');




