<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PayrollController;
use App\Http\Controllers\ProyectController;
use App\Http\Controllers\SalaryAdvanceController;
use App\Http\Controllers\UserController;
use App\Models\Proyect;
use Illuminate\Support\Facades\Auth;
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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes(['register'=>false]);

Route::get('login',function(){
    return view('auth.login');
})->name('login');

Route::group(['middleware' => 'auth:web'], function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('user', UserController::class);
    Route::resource('employee', EmployeeController::class);
    Route::resource('payroll', PayrollController::class);

    Route::resource('attendance', AttendanceController::class);
    Route::post('getData',[AttendanceController::class,'getData'])->name('attendance.getData');

    Route::resource('proyect', ProyectController::class);

    Route::delete('/remove_employee/{employee}/{proyect}',[EmployeeController::class.'removeEmployee'])->name('employee.remove_employee');

    Route::post('/add_employee/{proyect}',[EmployeeController::class,'addEmployee'])->name('employee.add_employee');

    Route::resource('salary-advances', SalaryAdvanceController::class);
});
