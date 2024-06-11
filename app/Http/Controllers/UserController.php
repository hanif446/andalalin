<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:user_show', ['only' => 'index']);
        $this->middleware('permission:user_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user_update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user_detail', ['only' => 'show']);
        $this->middleware('permission:user_delete', ['only' => 'destroy']);
        $this->middleware('permission:edit_profil_update', ['only' => ['edit_profil', 'update_profil']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $perPage = 10;
    public function index(Request $request)
    {
        $users = [];

        if($request->get('keyword')){
            $users = User::search($request->keyword)->paginate($this->perPage);
        } else {
            $users = User::orderBy('created_at', 'DESC')->paginate($this->perPage);
        }

        return view('users.index', [
            'users' => $users->appends(['keyword' => $request->keyword]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create', [
            'genders' => $this->genders()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //dd($request);
        //validation
        $validator = Validator::make( 
            $request->all(),
            [
                  "nama_user" => "required|string|max:30",
                  "jk" => 'required',
                  "tempat_lahir" => 'required',
                  "tgl_lahir" => 'required',
                  "no_hp" => 'required|numeric',
                  "email" => "required|email|unique:users,email",
                  "role" => "required",
                  "password" => "required|min:6|confirmed"
            ],
        );

        if($validator->fails()){
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        //Input Process
        DB::beginTransaction();
        try {
            $user = User::create([
                'nama_user' => $request->nama_user,
                'jk' => $request->jk,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_hp' => $request->no_hp,
                'email' => $request->email,
                'password' => Hash::make($request->password)
            ]);
            $user->assignRole($request->role);

            Alert::success('User', 'Berhasil Disimpan!');

            return redirect()->route('users.index');
        }catch (\Throwable $th){
            DB::rollBack();
            Alert::error('Tambah User', 'Error' . $th->getMessage());
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }finally{
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        return view('users.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('users.edit', [
            'user' => $user,
            'roleSelected' => $user->roles->first(),
            'genders' => $this->genders()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //validation
        $validator = Validator::make( 
            $request->all(),
            [
                  "nama_user" => "required|string|max:30",
                  "jk" => 'required',
                  "tempat_lahir" => 'required',
                  "tgl_lahir" => 'required',
                  "no_hp" => 'required',
                  "email" => "required|email|unique:users,email," .$user->id,
                  "role" => "required"
            ],
        );

        if($validator->fails()){
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $user->update([
                'nama_user' => $request->nama_user,
                'jk' => $request->jk,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_hp' => $request->no_hp,
                'email' => $request->email
            ]);
            $user->syncRoles($request->role);
            Alert::success('User', 'Berhasil Diubah!');
            return redirect()->route('users.index');
        }catch (\Throwable $th){
            DB::rollBack();
            Alert::error('Ubah User', 'Error' . $th->getMessage());
            $request['role'] = Role::select('id', 'name')->find($request->role);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }finally{
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        DB::beginTransaction();
        try {
            $user->removeRole($user->roles->first());
            $user->delete();

            Alert::success('User', 'Berhasil Dihapus!');
            return redirect()->back();

        }catch (\Throwable $th){
            Alert::error('Hapus Role', 'Error' . $th->getMessage());
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }     
    }

    public function change_password()
    {
      return view('users.change_password');
    }

    public function update_password(Request $request){
      $validator = Validator::make( 
            $request->all(),
            [
                  "old_password" => "required|min:6|max:100",
                  "new_password" => 'required|min:6|max:100',
                  "confirm_password" => 'required|same:new_password'
            ],
      );

      if($validator->fails()){
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        //dd($request->all());
      
      $current_user=Auth::user();

      if(Hash::check($request->old_password, $current_user->password)){
        $current_user->update([
            'password'=>Hash::make($request->new_password)
        ]);
        Alert::success('Password', 'Berhasil Diubah!');
        return redirect()->route('users.change_password');
      }else{
        Alert::error('Maaf', 'Password lama tidak cocok.');
        return redirect()->route('users.change_password');
      }
    }

    public function edit_profil(User $user)
    {
        return view('users.edit_profil', [
            'user' => $user,
            'roleSelected' => $user->roles->first(),
            'genders' => $this->genders()
        ]);
    }

    public function update_profil(Request $request, User $user)
    {
        //validation
        $validator = Validator::make( 
            $request->all(),
            [
                  "nama_user" => "required|string|max:30",
                  "jk" => 'required',
                  "tempat_lahir" => 'required',
                  "tgl_lahir" => 'required',
                  "no_hp" => 'required',
                  "email" => "required|email|unique:users,email," .$user->id,
            ],
        );

        DB::beginTransaction();
        try {
            $user->update([
                'nama_user' => $request->nama_user,
                'jk' => $request->jk,
                'tempat_lahir' => $request->tempat_lahir,
                'tgl_lahir' => $request->tgl_lahir,
                'no_hp' => $request->no_hp,
                'email' => $request->email
            ]);
            
            Alert::success('Profil', 'Berhasil Diubah!');
            return redirect()->route('dashboard.index');
        }catch (\Throwable $th){
            DB::rollBack();
            Alert::error('Edit Profil', 'Error' . $th->getMessage());
            
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }finally{
            DB::commit();
        }
    }

    private function genders()
    {
        return [
            'L' => 'Laki-Laki',
            'P' => 'Perempuan',
        ];
    }
}
