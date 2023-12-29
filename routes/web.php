<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\PaluUtamaController;
use App\Http\Controllers\FolderController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JayaPatriotController;
use App\Http\Controllers\TbUniversalController;
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

Route::get('/', [AuthController::class, 'login']);

Route::post('/signin', [AuthController::class, 'signin']);
Route::get('/signout', [AuthController::class, 'signout'])->name('signout');;

Route::group(['middleware' => ['AuthAdmin']], function () {

    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // document
    Route::get('/documents', [DocumentController::class, 'index'])->name('document.index');
    Route::get('/document/{id}/download', [DocumentController::class, 'download'])->name('document.download');
    Route::post('/document', [DocumentController::class, 'store'])->name('document.store');
    Route::patch('/document/{id}', [DocumentController::class, 'update'])->name('document.update');
    Route::delete('/document/{id}', [DocumentController::class, 'destroy'])->name('document.destroy');

    // paluutama
    Route::get('/paluutamas', [PaluUtamaController::class, 'index'])->name('paluutama.index');
    Route::get('/paluutama/{id}/download', [PaluUtamaController::class, 'download'])->name('paluutama.download');
    Route::post('/paluutama', [PaluUtamaController::class, 'store'])->name('paluutama.store');
    Route::patch('/paluutama/{id}', [PaluUtamaController::class, 'update'])->name('paluutama.update');
    Route::delete('/paluutama/{id}', [PaluUtamaController::class, 'destroy'])->name('paluutama.destroy');

    // paluutama
    Route::get('/tbuniversals', [TbUniversalController::class, 'index'])->name('tbuniversal.index');
    Route::get('/tbuniversal/{id}/download', [TbUniversalController::class, 'download'])->name('tbuniversal.download');
    Route::post('/tbuniversal', [TbUniversalController::class, 'store'])->name('tbuniversal.store');
    Route::patch('/tbuniversal/{id}', [TbUniversalController::class, 'update'])->name('tbuniversal.update');
    Route::delete('/tbuniversal/{id}', [TbUniversalController::class, 'destroy'])->name('tbuniversal.destroy');

    // paluutama
    Route::get('/jayapatriots', [JayaPatriotController::class, 'index'])->name('jayapatriot.index');
    Route::get('/jayapatriot/{id}/download', [JayaPatriotController::class, 'download'])->name('jayapatriot.download');
    Route::post('/jayapatriot', [JayaPatriotController::class, 'store'])->name('jayapatriot.store');
    Route::patch('/jayapatriot/{id}', [JayaPatriotController::class, 'update'])->name('jayapatriot.update');
    Route::delete('/jayapatriot/{id}', [JayaPatriotController::class, 'destroy'])->name('jayapatriot.destroy');

    // folder
    Route::get('/folders', [FolderController::class, 'index'])->name('folder.index');
    Route::post('/folder', [FolderController::class, 'store'])->name('folder.store');
    Route::patch('/folder/{id}', [FolderController::class, 'update'])->name('folder.update');
    Route::delete('/folder/{id}', [FolderController::class, 'destroy'])->name('folder.destroy');

    Route::get('/bantuan', [HomeController::class, 'bantuan'])->name('bantuan.index');
});
