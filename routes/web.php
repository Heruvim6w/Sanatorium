<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\ProfileController;
use App\Models\Category;
use Illuminate\Support\Facades\Route;

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
    $categories = Category::all();

    return view('index', compact('categories'));
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('documents', [DocumentController::class, 'index'])->name('documents.index');
    Route::get('documents/download/{document}', [DocumentController::class, 'download'])->name('documents.download');
});

Route::get('categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('categories/{category}', [CategoryController::class, 'show'])
    ->middleware('auth.categories')
    ->name('categories.show');

Route::resource('articles', ArticleController::class)->only(['show'])->middleware('auth.categories');

Route::get('about_us', [AboutController::class, 'show'])->name('about_us');

Route::get('agreement', static function () {
    return view('agreement');
})->name('agreement');

require __DIR__.'/auth.php';
