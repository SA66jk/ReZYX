<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Art_uploadController;
use App\Http\Controllers\Art_uploadController2;


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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/museum', [Art_uploadController::class, 'index']);

Route::get('/museum/create', [Art_uploadController::class, 'create'])->middleware('can:create,App\Models\Art_upload');

Route::post('/museum', [Art_uploadController::class, 'store'])->middleware('can:create,App\Models\Art_upload');

Route::get('/museum/{upload}/edit',[Art_uploadController::class, 'edit'])->middleware('can:update,upload');

Route::get('/museum/{upload}/{originalName?}', [Art_uploadController::class, 'show'])->middleware('can:view,upload');

Route::delete('/museum/{upload}', [Art_uploadController::class, 'destroy'])->middleware('can:delete,upload');

Route::put('/museum/{upload}', [Art_uploadController::class, 'update'])->middleware('can:update,upload');

 


Route::get('/sculpture', [Art_uploadController2::class, 'index']);

Route::get('/sculpture/create', [Art_uploadController2::class, 'create'])->middleware(['auth', 'verified']);

Route::post('/sculpture', [Art_uploadController2::class, 'store'])->middleware(['auth', 'verified']);

Route::get('/sculpture/{upload}/edit',[Art_uploadController2::class, 'edit'])->middleware(['auth', 'verified']);

Route::get('/sculpture/{upload}/{originalName?}', [Art_uploadController2::class, 'show'])->middleware(['auth', 'verified']);

Route::delete('/sculpture/{upload}', [Art_uploadController2::class, 'destroy'])->middleware(['auth', 'verified']);
                
Route::put('/sculpture/{upload}', [Art_uploadController2::class, 'update'])->middleware(['auth', 'verified']);



Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');



require __DIR__.'/auth.php';
