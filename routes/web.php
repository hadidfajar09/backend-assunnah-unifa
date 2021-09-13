<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Models\Category;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\ModuleController;
use App\Models\Module;

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

Route::get('/', function () {
    return redirect()->route('login');
});

Auth::routes();

Route::match(["GET", "POST"], "/register", function () { //untuk disable button route register
    return redirect('/login'); //route kembali ke form login
})->name("register");

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::view('template', 'layouts.bootstrap');

    Route::resource('users', UserController::class);
    Route::get('category/trash', [CategoryController::class, 'trash'])->name('category.trash');
    Route::get('category/{id}/restore', [CategoryController::class, 'restore'])->name('category.restore');
    Route::delete('category/{category}/delete-permanen', [CategoryController::class, 'deletePermanen'])->name('category.delete-permanen');
    Route::resource('category', CategoryController::class);


    Route::post('student/{student}/resetpassword', [StudentController::class, 'resetPass'])->name('student.resetpassword');
    Route::resource('student', StudentController::class);

    Route::get('course/trash', [CourseController::class, 'trash'])->name('course.trash');
    Route::get('course/{id}/restore', [CourseController::class, 'restore'])->name('course.restore');
    Route::delete('course/{course}/delete-permanen', [CourseController::class, 'deletePermanen'])->name('course.delete-permanen');
    Route::get('course/{course}/download', [CourseController::class, 'download'])->name('course.download');
    Route::resource('course', CourseController::class);


    Route::get('module', [ModuleController::class, 'index'])->name('module');
    Route::get('module/{id}/detail', [ModuleController::class, 'detail'])->name('module.detail');
    Route::get('module/{module}/create', [ModuleController::class, 'create'])->name('module.create');
    Route::post('module/store', [ModuleController::class, 'store'])->name('module.store');
    Route::get('module/{module}/edit', [ModuleController::class, 'edit'])->name('module.edit');
    Route::put('module/{module}/update', [ModuleController::class, 'update'])->name('module.update');
    Route::get('module/{module}/download', [ModuleController::class, 'download'])->name('module.download');
    Route::get('module/{module}/show', [ModuleController::class, 'show'])->name('module.show');
    Route::delete('module/{module}/destroy', [ModuleController::class, 'destroy'])->name('module.destroy');
});
