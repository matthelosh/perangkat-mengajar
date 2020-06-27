<?php
date_default_timezone_set('Asia/Jakarta');
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Middleware\isWali;
use App\Traits\Tanggal;
use Illuminate\Support\Facades\DB;

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
    Route::post('/impor', 'NilaiController@impor');
    Route::post('/unduh-format', 'NilaiController@downloadFormat');
    Route::post('/ganti/{id}', 'NilaiController@update');
    // Route::post('/view', 'NilaiController@view');
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
    Route::post('/impor', 'KdController@impor');
});

Route::group(['prefix' => 'pemetaan', 'middleware' => 'auth'], function(){
    Route::get('/', 'DashController@pemetaan');
    Route::post('/', 'PetaKDController@index');
});

Route::group(['prefix' => 'kaldik', 'middleware' => 'auth'], function(){
    Route::get('/', 'DashController@kaldik');
});

Route::group(['prefix' => 'rapor', 'middleware' => 'auth'], function() {
    Route::get('/', 'DashController@rapor');
    Route::get('/entri-nilai', 'DashController@entriNilai');
    Route::get('/entri-nilai-ekstra', 'DashController@entriNilaiEkstra');
    Route::get('/siswa', 'DashController@cetakRapor');
    Route::get('/cetak', 'NilaiController@cetakRapor');
    Route::post('/setting', function(Request $request) {
        try {
            DB::table('setting-raport')
                ->updateOrInsert([
                    'semester' => substr($request->tapel,2,2).substr($request->tapel,7,2).$request->semester,
                    'tanggal_rapor' => $request->tanggal_rapor
                ]);
            return back()->with(['status' => 'sukses', 'msg' => 'Setting Rapor ditambahkan/diperbarui']);
        } catch (\Exception $e)
        {
            return back()->with(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    });

    Route::post('/ganti-semester', function(Request $request) {
        $semester = substr($request->tapel,2,2).substr($request->tapel,7,2).$request->semester;
        session()->put('semester', $semester);
        return back()->with(['status' => 'sukses', 'msg' => 'Setting Rapor ditambahkan/diperbarui']);
    });
    Route::post('/saran/input', 'NilaiController@inputSaran');
   
});

Route::group(['prefix' => 'pengguna', 'middleware' => 'auth'], function(){
    Route::get('/', 'DashController@pengguna');
    Route::post('/', 'UserController@index');
    Route::post('/impor', 'UserController@import');
});

Route::group(['prefix' => 'sekolah', 'middleware' => 'auth'], function() {
    Route::get('/', 'DashController@sekolah');
    Route::post('/update', 'SekolahController@update');
});

// Nilai
Route::group(['prefix' => 'nilai', 'middleware' => 'auth'], function(){
    Route::post('/entri', 'NilaiController@create');
    Route::post('/ekstra/view', 'EkskulController@viewNilai');
    Route::post('/entri/ekstra', 'EkskulController@entri');
    Route::post('/ganti-nilai-ekstra/{id_nilai}', 'EkskulController@gantiNilai');
    Route::get('/saran', 'NilaiController@getOneSaran');
});

// Select2

Route::group(['prefix' => 'select', 'middleware' => 'auth'], function() {
    Route::post('kd', 'KdController@index');
    Route::post('ekskul', 'EkskulController@index');
});
// Khusus Wali Kelas
Route::get('/siswaku', 'DashController@siswaku');
Route::post('/siswaku', 'SiswaController@index');
Route::get('/logout', 'LoginController@logout')->name('logout');

Route::get('/coba', 'NilaiController@rekap');

// 