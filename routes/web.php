<?php

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
    return view('layouts/welcome');
});
Route::get('/register', function()
{
    return view('register');
});
Auth::routes();
/*Admin*/
Route::get('/home', 'HomeController@index');
/*fitur puskesmas*/
Route::get('/puskesmas', 'PuskesmasController@index');
Route::get('/tambahpuskesmas', 'PuskesmasController@tambahPuskesmas');
Route::post('/createpuskesmas', 'PuskesmasController@CreatePuskesmas');
Route::post('/deletepuskesmas', 'PuskesmasController@delete');
Route::post('/updatepuskesmas', 'PuskesmasController@UpdatePuskesmas');
/*fitur pendistribusian*/
Route::get('/pendistribusian', 'PendistribusianController@pendistribusian');
Route::post('/creatependistribusian', 'PendistribusianController@routing');
Route::post('/createdistribusi', 'PendistribusianController@createDistribusi');
Route::get('/hasil', 'PendistribusianController@hasil');
//Route::get('/kembali', 'PendistribusianController@kembali');
/*fitur obat*/
Route::get('/obat', 'ObatController@index');
Route::get('/tambahobat', 'ObatController@tambahObatForm');
Route::post('/createobat', 'ObatController@CreateObat');
Route::post('/deleteobat', 'ObatController@delete');
Route::post('/updateobat', 'ObatController@UpdateObat');
/*fitur monitoring user*/
Route::get('/user', 'UserController@index');
Route::get('/verifikasiuser/{id}', 'UserController@Verifikasi');

/*User*/
Route::get('/pendistribusianuser', 'PendistribusianController@pendistribusianUser');
Route::get('/tambahpendistribusian', 'PendistribusianController@tambahPendistribusian');
Route::get('/jarak', 'JarakController@index');
Route::get('/tambahjarakpuskesmas', 'JarakController@tambahJarakPuskesmas');
Route::post('/createjarak', 'JarakController@CreateJarak');

Route::get('/logout',function(){
    Auth::logout();
    redirect('/login');
});