<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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

Route::get('search_img', [UserController::class, 'search_img']);

Route::delete('deleteImage/{id}', [UserController::class, 'delete']);
Route::get('/',[UserController::class,'home']);
// Route::get('/',[UserController::class,'welcome']);

Auth::routes();


Route::post('/store_data', [UserController::class, 'store_data']);


