<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\TrashController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SubsiController;
use App\Http\Controllers\UserController;
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
    $title = "Rubabox";
    return view('landing-page.index',['title'=>$title]);
});


Route::get('/about', function () {
    $title = "About";
    return view('landing-page.about',['title'=>$title]);
});

Route::get('/contact', function () {
    $title = "Contact";
    return view('landing-page.contact',['title'=>$title]);
});

Route::get('/faq', function () {
    $title = "FAQ";
    return view('landing-page.faq',['title'=>$title]);
});

Route::get('/about', function () {
    $title = "About";
    return view('landing-page.about',['title'=>$title]);
});

//Route for login
Route::get('/login', function () {
    $title = "Login";
    return view('login',['title'=>$title]);
})->name('login');

//Authenticate Login
Route::post('/postLogin',[LoginController::class,'postLogin'])->name('postLogin');

//Authenticate Logout
Route::get('/logout',[LoginController::class,'logout'])->name('logout');

//Route access for admin
Route::group(['middleware' => 'auth:admin'], function(){
    Route::resource('/user',UserController::class);
    Route::get('/dashboard/user',[UserController::class,'index']);
    Route::get('/delete/user/{id}',[UserController::class,'destroy']);
    Route::get('/edit/user/{id}',[UserController::class,'edit']);
    Route::post('/edit/user',[UserController::class,'update']);
    Route::get('/search/user',[UserController::class,'search']);
    Route::resource('/admin',AdminController::class);
    Route::get('/dashboard/admin',[AdminController::class,'index']);
    Route::get('/delete/admin/{id}',[AdminController::class,'destroy']);
    Route::get('/edit/admin/{id}',[AdminController::class,'edit']);
    Route::post('/edit/admin',[AdminController::class,'update']);
    Route::resource('/subsi',SubsiController::class);
    Route::get('/delete/subsi/{subsi_code}',[SubsiController::class,'destroy']);
    Route::get('/edit/subsi/{subsi_code}',[SubsiController::class,'edit']);
    Route::post('/edit/subsi',[SubsiController::class,'update']);
    Route::resource('/employee',EmployeeController::class);
    Route::get('/delete/employee/{nip}',[EmployeeController::class,'destroy']);
    Route::get('/edit/employee/{nip}',[EmployeeController::class,'edit']);
    Route::post('/edit/employee',[EmployeeController::class,'update']);
    Route::get('/dashboard/history',[HistoryController::class,'index']);
    Route::get('/delete/history',[HistoryController::class,'destroy']);
});

//Route access for admin and user
Route::group(['middleware' => ['auth:admin,user']], function(){
    Route::get('/dashboard', [DashboardController::class,'index']);
    Route::get('/dashboard/subsi',[SubsiController::class,'index']);
    Route::get('/search/employee',[EmployeeController::class,'search']);
    Route::get('/dashboard/employee',[EmployeeController::class,'index']);
    Route::get('/dashboard/upload',[FileController::class,'index']);
    Route::resource('/files',FileController::class);
    Route::get('/delete/file/{file_code}',[FileController::class,'destroy']);
    Route::get('/edit/file/{file_code}',[FileController::class,'edit']);
    Route::post('/edit/file',[FileController::class,'update']);
    Route::get('/dashboard/trash',[TrashController::class,'index']);
    Route::get('/search/trash',[TrashController::class,'search_trash']);
    Route::get('/trash/restore/{file_code}',[TrashController::class,'restore']);
    Route::get('/trash/force-delete/{file_code}',[TrashController::class,'forceDelete']);
    Route::get('/trash/restore-all',[TrashController::class,'restoreAll']);
    Route::get('/trash/delete-all',[TrashController::class,'forceDeleteAll']);
    Route::get('/search/file',[FileController::class,'search_file']);
    Route::get('/see-all/file',[FileController::class,'seeAll']);
});






