<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;



// Route::get('/', function () {
//     return view('backend.dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/pw', function () {
    // echo $password;
    // echo "\n";
    $password = "";
    $hashedPassword = Hash::make($password);
    echo $hashedPassword;
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/section/listorder', [CategoryController::class, 'edit_listorder'])->name('dashboard.category_listorder');
    Route::post('/section/listorder/update', [CategoryController::class, 'update_listorder'])->name('dashboard.category_update_listorder');

    Route::get('/section', [CategoryController::class, 'index'])->name('dashboard.category');
    Route::get('/section/create', [CategoryController::class, 'create'])->name('dashboard.category_create');
    Route::post('/section/store', [CategoryController::class, 'store'])->name('dashboard.category_store');
    Route::get('/section/edit/{id}', [CategoryController::class, 'edit'])->name('dashboard.category_edit');
    Route::post('/section/update/', [CategoryController::class, 'update'])->name('dashboard.category_update');
    Route::get('/section/delete/{id}', [CategoryController::class, 'destroy'])->name('dashboard.category_delete');

    Route::get('/section/{id}/list', [CategoryController::class, 'data_list'])->name('dashboard.category_data_list');
    Route::get('/section/{id}/list/create', [CategoryController::class, 'data_create'])->name('dashboard.category_data_create');
    Route::post('/section/list/store', [CategoryController::class, 'data_store'])->name('dashboard.category_data_store');
    Route::get('/section/list/edit/{id}/', [CategoryController::class, 'data_edit'])->name('dashboard.category_data_edit');
    Route::post('/section/list/update/', [CategoryController::class, 'data_update'])->name('dashboard.category_data_update');
    Route::get('/section/list/delete/{id}/', [CategoryController::class, 'data_delete'])->name('dashboard.category_data_delete');

    Route::get('/section/{id}/listorder', [CategoryController::class, 'data_edit_listorder'])->name('dashboard.category_data_edit_listorder');
    Route::post('/section/{id}/listorder/update', [CategoryController::class, 'data_update_listorder'])->name('dashboard.category_data_update_listorder');


});
