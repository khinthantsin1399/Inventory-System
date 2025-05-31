<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SystemFileController;
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

Route::redirect('/', '/login');
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::group(['prefix' => 'category', 'as' => 'category.'], function () {
    Route::get('/list', 'CategoryController@showList')
    ->name('list.show');
    Route::post('/list/data', 'CategoryController@getCategoryListForDataTable')
    ->name('list.data');
    Route::get('/show_create', 'CategoryController@showCreate')
    ->name('create.show');
    Route::post('/create', 'CategoryController@actionCreate')
    ->name('create');
    Route::get('/edit/{id}', 'CategoryController@showEdit')
    ->name('edit.show');
    Route::post('/update/{id}', 'CategoryController@actionUpdate')
    ->name('update');
    Route::post('/delete/{id}', 'CategoryController@deleteCategory')
    ->name('delete');
});

Route::group(['prefix' => 'brand', 'as' => 'brand.'], function () {
    Route::get('/list', 'BrandController@showList')
    ->name('list.show');
    Route::post('/list/data', 'BrandController@getBrandListForDataTable')
    ->name('list.data');
    Route::get('/show_create', 'BrandController@showCreate')
    ->name('create.show');
    Route::post('/create', 'BrandController@actionCreate')
    ->name('create');
    Route::get('/edit/{id}', 'BrandController@showEdit')
    ->name('edit.show');
    Route::post('/update/{id}', 'BrandController@actionUpdate')
    ->name('update');
    Route::post('/delete/{id}', 'BrandController@deleteBrand')
    ->name('delete');
});

Route::group(['prefix' => 'product', 'as' => 'product.'], function () {
    Route::get('/list', 'ProductController@showList')
    ->name('list.show');
    Route::post('/list/data', 'ProductController@getProductListForDataTable')
    ->name('list.data');
    Route::get('/detail/{id}', 'ProductController@showDetail')
    ->name('detail.show');
    Route::get('/show_create', 'ProductController@showCreate')
    ->name('create.show');
    Route::post('/create', 'ProductController@actionCreate')
    ->name('create');
    Route::get('/edit/{id}', 'ProductController@showEdit')
    ->name('edit.show');
    Route::post('/update/{id}', 'ProductController@actionUpdate')
    ->name('update');
    Route::post('/delete/{id}', 'ProductController@deleteProduct')
    ->name('delete');
    Route::post('/download-csv', 'ProductController@downloadProductCsv')
    ->name('csv.download');
});

Route::group(['prefix' => 'tmpfile', 'as' => 'tmpfile.'], function () {
    Route::post('/tmpfile-upload', [SystemFileController::class, 'uploadTmpFile'])->name('upload');
    Route::post('/tmpfile-delete', [SystemFileController::class, 'deleteTmpFile'])->name('delete');
});

require __DIR__.'/auth.php';
