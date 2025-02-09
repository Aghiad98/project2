<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
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

Route::group(['middleware'=>['auth']],function(){


    Route::get ("/" ,[PostController ::class , 'index'])->name('posts.index');

/*     Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
 */

     Route::get('posts/{post}', [PostController::class, 'show'])->name('posts.show');

     Route::get('/posts', [PostController::class, 'create'])->name('posts.create');

     Route::post('posts', [PostController::class, 'store'])->name('posts.store');



    Route::post('logout',[AuthController::class ,'logout'])->name('logout');



    Route::group(['middleware'=>['role:admin']],function(){

    Route::get ("/admin" ,[AdminController::class , 'index'])->name('admin.index');

    Route::post ("/admin/roles" ,[AdminController ::class , 'createRole'])->name('admin.createRoles');

    Route::post ("/admin/users/{user}/assign-role" ,[AdminController ::class , 'assignRole'])->name('admin.assignRoles');

    Route::delete ("/admin/roles/{role}" ,[AdminController ::class , 'deleteRole'])->name('admin.deleteRoles');

    Route::post ("/admin/roles/{role}/assign-permission" ,[AdminController::class,'assignPermissionToRoles'])->name('admin.assignPermissionToRoles');

    Route::post ("/admin/roles/{role}/remove-permission" ,[AdminController::class,'removePermissionFromRoles'])->name('admin.removePermissionFromRoles');

    Route::delete ("/admin/users/{user}" ,[AdminController ::class , 'deleteUser'])->name('admin.deleteUser');

     Route::resource('tags',TagController::class);
    Route::resource('Categories',CategoryController::class);

});

   Route::group(['middleware' => ['can:manage comment']], function () {
    Route::resource('posts.comments', CommentController::class);
});
Route::group(['middleware' => ['can:manage posts']], function () {
    Route::resource('posts', PostController::class)->except('index','show','create','store');
});
});
    Route::group(['middleware'=>['guest']],function(){

    Route::get('login',[AuthController::class,'showLoginForm'])->name('login');
    Route::post('login',[AuthController::class,'login']);

    Route::get('register',[AuthController::class,'showRegisterForm'])->name('register');
    Route::post('register',[AuthController::class,'register']);

});

