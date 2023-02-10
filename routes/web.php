<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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
Route::get('/','App\Http\Controllers\Controller@data')->name("main")->middleware("loggedin");
Route::post('/lokasi_posyandu_update','App\Http\Controllers\Controller@update_posyandu')->name("update_posyandu")->middleware("loggedin");
Route::get('/login',function(){
    return View("auth/login");
})->middleware("tokenvalidation");
Route::get('/register',function(){
    return View("auth/regis");
})->middleware("tokenvalidation");

Route::post('/login','App\Http\Controllers\UserController@login')->middleware("tokenvalidation");
Route::post('/register','App\Http\Controllers\UserController@register')->middleware("tokenvalidation");
Route::get('/logout','App\Http\Controllers\UserController@logout')->middleware("loggedin");

Route::get('/user','App\Http\Controllers\UserController@index')->name("user")->middleware("loggedin");
Route::get('/user/{id}','App\Http\Controllers\UserController@bdetail')->name("user_detail")->middleware("loggedin");
Route::get('/user_tambah','App\Http\Controllers\UserController@tambah')->name("user_tambah")->middleware("loggedin");
Route::post('/user_tambah/create','App\Http\Controllers\UserController@create')->name("user_add")->middleware("loggedin");
Route::get('/user_edit/{id}','App\Http\Controllers\UserController@edit')->name("user_edit")->middleware("loggedin");
Route::post('/user_edit/update','App\Http\Controllers\UserController@update')->name("user_update")->middleware("loggedin");
Route::post('/user_delete/{id}','App\Http\Controllers\UserController@delete')->name("user_delete")->middleware("loggedin");


// Berita
Route::get('/berita','App\Http\Controllers\BeritaController@index')->name("berita")->middleware("loggedin");
Route::get('/berita/{id}','App\Http\Controllers\BeritaController@berita_detail')->name("berita_detail")->middleware("loggedin");
Route::get('/berita_tambah','App\Http\Controllers\BeritaController@tambah')->name("berita_tambah")->middleware("loggedin");
Route::post('/berita_tambah/create','App\Http\Controllers\BeritaController@create')->name("berita_add")->middleware("loggedin");
Route::get('/berita_edit/{id}','App\Http\Controllers\BeritaController@edit')->name("berita_edit")->middleware("loggedin");
Route::post('/berita_edit/update','App\Http\Controllers\BeritaController@update')->name("berita_update")->middleware("loggedin");
Route::post('/berita_delete/{id}','App\Http\Controllers\BeritaController@delete')->name("berita_delete")->middleware("loggedin");


// Rapot
Route::get('/rapot','App\Http\Controllers\RapotController@index')->name("rapot")->middleware("loggedin");
Route::get('/rapot_anak/{id}','App\Http\Controllers\RapotController@rapot_anak')->name("rapot_anak")->middleware("loggedin");
Route::get('/rapot_anak_list/{id_anak}','App\Http\Controllers\RapotController@rapot_anak_list')->name("rapot_anak_list")->middleware("loggedin");
Route::get('/rapot_anak_add/{id_anak}','App\Http\Controllers\RapotController@rapot_anak_add')->name("rapot_anak_add")->middleware("loggedin");
Route::post('/rapot_anak_add/tambah','App\Http\Controllers\RapotController@rapot_anak_form_tambah')->name("rapot_anak_form_tambah")->middleware("loggedin");
Route::get('/rapot_anak_edit/{id_anak}/{id_rapor}','App\Http\Controllers\RapotController@rapot_anak_edit')->name("rapot_anak_edit")->middleware("loggedin");
Route::post('/rapot_anak_edit/update','App\Http\Controllers\RapotController@rapot_anak_form_update')->name("rapot_anak_form_update")->middleware("loggedin");


// Posyandu
Route::get('/posyandu','App\Http\Controllers\PosyanduController@index')->name("posyandu")->middleware("loggedin");
Route::get('/posyandu/{id}','App\Http\Controllers\PosyanduController@bdetail')->name("posyandu_detail")->middleware("loggedin");
Route::get('/posyandu_tambah','App\Http\Controllers\PosyanduController@tambah')->name("posyandu_tambah")->middleware("loggedin");
Route::post('/posyandu_tambah/create','App\Http\Controllers\PosyanduController@create')->name("posyandu_add")->middleware("loggedin");
Route::get('/posyandu_edit/{id}','App\Http\Controllers\PosyanduController@edit')->name("posyandu_edit")->middleware("loggedin");
Route::post('/posyandu_edit/update','App\Http\Controllers\PosyanduController@update')->name("posyandu_update")->middleware("loggedin");
Route::post('/posyandu_delete/{id}','App\Http\Controllers\PosyanduController@delete')->name("posyandu_delete")->middleware("loggedin");


// Route::get('dashboard', [AuthController::class, 'dashboard']); 
// Route::get('login', [AuthController::class, 'index'])->name('login');
// Route::post('custom-login', [AuthController::class, 'customLogin'])->name('login.custom'); 
// Route::get('registration', [AuthController::class, 'registration'])->name('register-user');
// Route::post('custom-registration', [AuthController::class, 'customRegistration'])->name('register.custom'); 
// Route::get('signout', [AuthController::class, 'signOut'])->name('signout');

// Route::get('/', function () {
//     return view('welcome');
// });