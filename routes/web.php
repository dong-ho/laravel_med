<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AdminMenuController;
use App\Http\Controllers\Admin\AdminProfileController;
use App\Http\Controllers\Admin\AdminManagerController;
use App\Http\Controllers\Admin\AdminUserController;
use App\Http\Controllers\Admin\UserMenuController;
use App\Http\Controllers\Agent\AgentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/',[UserController::class,'UserIndex'])->name('user.index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

//사이트 관리자
Route::prefix('/admin')->middleware(['auth', 'role:admin'])->group(function (){

    Route::get('/',[AdminController::class, 'AdminIndex'])->name('admin');
    Route::get('/logout',[AdminController::class, 'AdminLogOut'])->name('admin.logout');

    /**
     * Admin Profile Route
     */
    Route::get('/profile',[AdminProfileController::class, 'Profile'])->name('admin.profile.edit');
    Route::post('/profile',[AdminProfileController::class, 'ProfileUpdate'])->name('admin.profile.update');
    Route::post('/profile/photo_delete',[AdminProfileController::class, 'PhotoDelete'])->name('admin.profile.photo.delete');

    /**
     * Admin Menu Route
     */
    Route::get( '/menu'             ,[AdminMenuController::class, 'List'])      ->name('admin.menu');
    Route::get( '/menu/add'         ,[AdminMenuController::class, 'Add'])       ->name('admin.menu.add');
    Route::post('/menu/add'         ,[AdminMenuController::class, 'Store'])     ->name('admin.menu.store');
    Route::get( '/menu/edit/{id}'   ,[AdminMenuController::class, 'Edit'])      ->name('admin.menu.edit');
    Route::post('/menu/edit/{id}'   ,[AdminMenuController::class, 'Update'])    ->name('admin.menu.update');
    Route::get('/menu/delete/{id}'  ,[AdminMenuController::class, 'Delete'])    ->name('admin.menu.delete');

    /**
     * Admin User Route
     */
    Route::get( '/manager'             ,[AdminManagerController::class, 'List'])      ->name('admin.manager');
    Route::get( '/manager/add'         ,[AdminManagerController::class, 'Add'])       ->name('admin.manager.add');
    Route::post('/manager/add'         ,[AdminManagerController::class, 'Store'])     ->name('admin.manager.store');
    Route::get( '/manager/edit/{id}'   ,[AdminManagerController::class, 'Edit'])      ->name('admin.manager.edit');
    Route::post('/manager/edit/{id}'   ,[AdminManagerController::class, 'Update'])    ->name('admin.manager.update');
    Route::get('/manager/delete/{id}'  ,[AdminManagerController::class, 'Delete'])    ->name('admin.manager.delete');
    Route::post('/manager/photo_delete',[AdminManagerController::class, 'PhotoDelete'])->name('admin.manager.photo.delete');

    /**
     * User Route
     */
    Route::get( '/user'             ,[AdminUserController::class, 'List'])      ->name('admin.user');
    Route::get( '/user/add'         ,[AdminUserController::class, 'Add'])       ->name('admin.user.add');
    Route::post('/user/add'         ,[AdminUserController::class, 'Store'])     ->name('admin.user.store');
    Route::get( '/user/edit/{id}'   ,[AdminUserController::class, 'Edit'])      ->name('admin.user.edit');
    Route::post('/user/edit/{id}'   ,[AdminUserController::class, 'Update'])    ->name('admin.user.update');
    Route::get('/user/delete/{id}'  ,[AdminUserController::class, 'Delete'])    ->name('admin.user.delete');
    Route::post('/user/photo_delete',[AdminUserController::class, 'PhotoDelete'])->name('admin.user.photo.delete');

    /**
     * User Menu Route
     */
    Route::get( '/usermenu'             ,[UserMenuController::class, 'List'])      ->name('admin.usermenu');
    Route::get( '/usermenu/add'         ,[UserMenuController::class, 'Add'])       ->name('admin.usermenu.add');
    Route::post('/usermenu/add'         ,[UserMenuController::class, 'Store'])     ->name('admin.usermenu.store');
    Route::get( '/usermenu/edit/{id}'   ,[UserMenuController::class, 'Edit'])      ->name('admin.usermenu.edit');
    Route::post('/usermenu/edit/{id}'   ,[UserMenuController::class, 'Update'])    ->name('admin.usermenu.update');
    Route::get('/usermenu/delete/{id}'  ,[UserMenuController::class, 'Delete'])    ->name('admin.usermenu.delete');

});
Route::prefix('/admin')->group(function (){
    Route::get('/login',[AdminController::class,'AdminLogin'])->name('admin.login');
});



//에이전트 관리자
Route::prefix('agent')->middleware(['auth','role:agent'])->group(function (){
    Route::get('/',[AgentController::class,'AgentIndex'])->name('agent.index');
});



