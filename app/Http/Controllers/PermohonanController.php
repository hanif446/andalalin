<?php

namespace App\Http\Controllers;

use App\Models\Permohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PermohonanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:data_permohonan_show', ['only' => 'index']);
        $this->middleware('permission:data_permohonan_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:data_permohonan_update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:data_permohonan_delete', ['only' => 'destroy']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    private $perPage = 5;

    public function index(Request $request)
    {
        $permohonans = $request->get('keyword') 
            ? Permohonan::search($request->keyword)->paginate($this->perPage)
            : Permohonan::orderBy('created_at', 'DESC')->paginate($this->perPage);

        return view('permohonan.index', [
            'permohonans' => $permohonans->appends(['keyword' => $request->keyword])
        ]);
    }

    public function select(Request $request)
    {
        $permohonan = [];
        if($request->has('q')){
            $permohonan = Permohonan::select('id', 'judul', 'jenis', 'ukuran')->search($request->q)->get();
        }else{
            $permohonan = Permohonan::select('id', 'judul', 'jenis', 'ukuran')->limit(5)->get();
        }

        return response()->json($permohonan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('permohonan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
                'judul' => 'required',
                'jenis' => 'required',
                'ukuran' => 'required',
                'kategori' => 'required'
        ]);
        try {
            Permohonan::create([
               'judul' => $request->judul,
               'jenis' => $request->jenis,
               'ukuran' => $request->ukuran,
               'kategori' => $request->kategori
            ]);
            Alert::success('Data Permohonan', 'Berhasil Disimpan!');
            return redirect()->route('data-permohonan.index');
        }catch (\Throwable $th){

        }
        Alert::error('Tambah Data Permohonan', 'Error' . $th->getMessage());
        return redirect()->back()->withInput($request->all())->withErrors($th);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function show(Permohonan $permohonan)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function edit(Permohonan $data_permohonan)
    {
        return view('permohonan.edit', compact('data_permohonan'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Permohonan $data_permohonan)
    {
        $request->validate([
            'judul' => 'required',
            'jenis' => 'required',
            'ukuran' => 'required',
            'kategori' => 'required'
        ]);

        try {
            $data_permohonan->update([
               'judul' => $request->judul,
               'jenis' => $request->jenis,
               'ukuran' => $request->ukuran,
               'kategori' => $request->kategori
            ]);
            Alert::success('Data Permohonan', 'Berhasil Diubah!');
            return redirect()->route('data-permohonan.index');
        }catch (\Throwable $th){

        }
        Alert::error('Ubah Data Permohonan', 'Error' . $th->getMessage());
        return redirect()->back()->withInput($request->all())->withErrors($th);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function destroy(Permohonan $data_permohonan)
    {
        try {
            $data_permohonan->delete();
            Alert::success('Data Permohonan', 'Berhasil Dihapus!');
            return redirect()->route('data-permohonan.index');
        }catch (\Throwable $th){
            Alert::error('Hapus Data Permohonan', 'Error' . $th->getMessage());
            return redirect()->back()->withErrors($th);
        }
    }
}
