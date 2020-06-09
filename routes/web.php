<?php
date_default_timezone_set('Asia/Jakarta');
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\isWali;
use App\Traits\Tanggal;
// use Closure;

// use Auth;
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
Route::get('/', function(Request $request){
  if(Auth::check()){
      return redirect('/home')->with(['status' => 'sukses', 'msg' => 'Anda sudah login.']);
  } else {
    return redirect('/login');
  }
});

Route::get('/login', function (Request $request) {
    if(Auth::check()){
        return redirect('/home')->with(['status' => 'sukses', 'msg' => 'Anda sudah login.']);
    } else {
      return view('login');
    }


})->name('login')->middleware('CheckAuth');



Route::post('/login', 'LoginController@login');


Route::get('/home', 'DashController@home')->middleware('auth');

Route::group(['prefix' => 'siswa', 'middleware' => 'auth'], function(){
    Route::get('/', 'DashController@siswa');
    Route::post('/', 'SiswaController@index');
});

Route::group(['prefix' => 'nilai', 'middleware' => 'auth'], function() {
    Route::get('/', 'DashController@nilai');
    Route::post('/', 'NilaiController@index');
});
Route::group(['prefix' => 'rombel', 'middleware' => 'auth'], function() {
    Route::get('/', 'DashController@rombel');
    Route::post('/', 'RombelController@index');
});
Route::group(['prefix' => 'semester', 'middleware' => 'auth'], function() {
    Route::get('/', 'DashController@semester');
    Route::post('/', 'SemesterController@index');
});

Route::group(['prefix' => 'mapel', 'middleware' => 'auth'], function(){
    Route::post('/', 'MapelController@index');
});

Route::group(['prefix' => 'kompetensi', 'middleware' => 'auth'], function(){
    Route::get('/', 'DashController@kompetensi');
    Route::post('/', 'KdController@index');
});

Route::group(['prefix' => 'pemetaan', 'middleware' => 'auth'], function(){
    Route::get('/', 'DashController@pemetaan');
    Route::post('/', 'PetaKDController@index');
});

Route::group(['prefix' => 'kaldik', 'middleware' => 'auth'], function(){
    Route::get('/', 'DashController@kaldik');
});
Route::get('/logout', 'LoginController@logout')->name('logout');
