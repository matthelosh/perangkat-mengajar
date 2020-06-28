<?php
namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use \Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Yajra\DataTables\Facades\DataTables;
use Symfony\Component\Console\Input\Input;

class UserController extends Controller
{

  public function paginate($items, $perPage = 10, $page = null, $options = [])
  {
    $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
  }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if($request->query('req')) {
            switch($request->query('req'))
            {
                case "dt":
                    $users = User::all();
                    return DataTables::of($users)->addIndexColumn()->make(true);
                break;
                case "cetak":
                    return response()->json(['status' => 'sukses', 'msg' => 'Data User', 'gurus' => $users, 'sekolah' => 'App\Sekolah'::where('npsn', Auth::user()->sekolah_id)->first()]);
                break;
                case "select":
                    if($request->q != '') {
                        $gurus = User::where([
                            ['sekolah_id','=', Auth::user()->sekolah_id],
                            ['level','=','guru'],
                            ['fullname', 'LIKE', '%'.$request->q.'%']
                        ])->get();
                    } else {
                      if($request->query('role') == 'wali') {
                        $gurus =  $gurus = User::where(['role' => 'wali'])->get();
                      }
                        $gurus = User::where(['level' => 'guru'])->get();
                    }
                    $data = [];
                    foreach($gurus as $guru)
                    {
                        array_push($data, ['id' => $guru->nip, 'text' => $guru->fullname]);
                    }
                    $datas = json_decode(json_encode($data));
                    return response()->json(['status' => 'sukses', 'msg' => 'Select Guru', 'gurus' => $datas]);
                break;
            }

      }
        $users = User::with('sekolahs')->get();
    //   dd($users);
      return view('pages.admin.dashboard', ['page_title' => 'Pengguna', 'users' => $users]);

    }

    public function print()
    {
      try {
        $users;
        if (Auth::user()->level == 'superadmin') {
          $users = User::all();

        }

        return response()->json(['status' => 'sukses', 'msg' => 'Data Pengguna', 'users' => $users]);
      } catch (\Exception $e) {
        return response()->json(['status' => 'gagal', 'msg' => $e->getCode().':'.$e->getMessage()]);
      }

    }

    public function find(Request $request)
    {
      // dd($request->all());
      if($request->q){
        $q = $request->q;
        $gurus = User::where('username', 'LIKE', '%'.$q.'%')->orWhere('fullname', 'LIKE', '%'.$q.'%')->orWhere('email', 'LIKE', '%'.$q.'%')->paginate(10);
        $admins = \App\Admin::where('username', 'LIKE', '%'.$q.'%')->orWhere('fullname', 'LIKE', '%'.$q.'%')->orWhere('email', 'LIKE', '%'.$q.'%')->paginate(10);
        if ($users->count() > 0) {
          return view('pages.admin.dashboard', ['page_title' => 'Pengguna', 'users' => $users]);
        }
        return view('pages.admin.dashboard', ['page_title' => 'Pengguna'])->with(['status' => 'Data tidak ditemukan']);

      } else {
        // $users = User::paginate(15);
        // return view('pages.admin.dashboard', ['page_title' => 'Pengguna', 'users' => $users]);
        return redirect('/admin/users');
      }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
      $validator  = Validator::make($request->all(), [
        'nip' => 'required',
        'username' => 'required',
        'email' => 'required|email',
        'password' => 'required',
        'fullname' => 'required',
        'level' => 'required',
        'role' => 'required',
        'hp' => 'required',
      ]);

      if ( $validator->fails() ) {
        return back()->withError($validator->errors());
      }
      try {
        if($request->level == 'guru'||$request->level == 'staf') {
          User::create([
            'nip' => $request->nip,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->email),
            'fullname' => $request->fullname,
            'level' => $request->level,
            'role' => $request->role,
            'hp' => $request->hp,
            'sekolah_id' => Auth::user()->sekolah_id
          ]);
          return redirect('/admin/guru')->with(['status' => 'sukses', 'msg' => 'Data Guru Disimpan.']);
        } elseif ($request->level == 'admin') {
          \App\Admin::create([
            'nip' => $request->nip,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->email),
            'fullname' => $request->fullname,
            'level' => $request->level,
            'role' => $request->role,
            'hp' => $request->hp,
            'sekolah_id' => $request->sekolah_id
          ]);
          return redirect('/admin/users')->with(['status' => 'sukses', 'msg' => 'Data Pengguna disimpan']);
        }


      } catch (\Exception $e) {
        return back()->with(['status' => 'error', 'msg' => $e->getCode().':'. $e->getMessage()]);
      }

    }

    public function import(Request $request)
    {
      $file = $request->file('file');
      Excel::import(new UsersImport, $file);

      return back()->with(['status' => 'sukses', 'msg' => 'Data Users diimpor']);
    }

    public function export(Request $request)
    {
        // $users = User::all();
        // try {
        //   // Request::server('PATH_INFO')
        //   $filename = 'users.xlsx';
        //   $users =  Excel::store(new UsersExport, $filename);
        //   return response()->json(['status' => 'sukses', 'link' => 'http://'.$request->getHttpHost().'/download/'.$filename]);
        // } catch (\Exception $e) {
        //   return response()->json(['status' => 'gagal', 'msg' => $e->getCode().':'.$e->getMessage()]);
        // }
        return Excel::download(new UsersExport, 'users.xlsx');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

       try {
        if(!$request->password){
            $Input = $request->except('password');
        } else {
            $Input = $request->all();
            $Input['password'] = Hash::make($Input['password']);
        }
           User::findOrFail($id)->update($Input);
           return redirect('/admin/guru')->with(['status' => 'sukses', 'msg' => 'Data GUru diperbarui.']);
       } catch (\Exception $e) {
           return back()->with(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
       }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        try {
            User::find($id)->delete();
            return response()->json(['status' => 'sukses', 'msg' => 'Data User/Guru dihapus']);
        } catch (\Exception $e)
        {
            return response()->json(['status' => 'error', 'msg' => $e->getCode().':'.$e->getMessage()]);
        }
    }
}
