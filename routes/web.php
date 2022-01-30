<?php

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
use App\Http\Controllers\EmailController;
use App\Http\Controllers\Admin\{AuthController,DashboardController,CompaniesController,EmployeesController};
Route::get('/', function () {
    return view('index');
});
Route::get('/admin/login',[AuthController::class,'getLogin'])->name('getLogin');
Route::post('/admin/login',[AuthController::class,'postLogin'])->name('postLogin');
Route::group(['middleware'=>['admin_auth']],function(){
    
Route::get('/admin/dashboard',[DashboardController::class,'dashboard'])->name('dashboard');
// Route::get('/admin/users',[UserController::class,'index'])->name('users.index');
 Route::resource('companies', CompaniesController::class);
 Route::resource('employees', EmployeesController::class);
Route::get('/admin/logout',[DashboardController::class,'logout'])->name('logout');
Route::get('send-email', [App\Http\Controllers\EmailController::class, 'sendEmail']);
});
