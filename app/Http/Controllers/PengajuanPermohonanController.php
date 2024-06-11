<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPermohonan;
use App\Models\Permohonan;
use App\Models\Provinsi;
use App\Models\BuktiPermohonan;
use App\Models\AlamatPemohon;
use App\Models\AlamatPerusahaan;
use App\Models\StatusPermohonan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class PengajuanPermohonanController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:pengajuan_permohonan_show', ['only' => 'index']);
        $this->middleware('permission:pengajuan_permohonan_create', ['only' => ['create', 'store']]);
        $this->middleware('permission:pengajuan_permohonan_update', ['only' => ['edit', 'update']]);
        $this->middleware('permission:pengajuan_permohonan_detail', ['only' => 'show']);
        $this->middleware('permission:pengajuan_permohonan_delete', ['only' => 'destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $perPage = 5;

    public function index(Request $request)
    {
        $pengajuan_permohonan = [];

        if($request->get('keyword')){
            $pengajuan_permohonans = PengajuanPermohonan::leftJoin('permohonans', 'pemohons.permohonan_id', '=', 'permohonans.id')
               ->leftJoin('status_permohonans', 'pemohons.id', '=', 'status_permohonans.pemohon_id')
               ->select('pemohons.*', 'permohonans.judul', 'status_permohonans.status')
               ->search($request->keyword)
               ->paginate($this->perPage);
        } else {
            $pengajuan_permohonans = PengajuanPermohonan::leftJoin('permohonans', 'pemohons.permohonan_id', '=', 'permohonans.id')
               ->leftJoin('status_permohonans', 'pemohons.id', '=', 'status_permohonans.pemohon_id')
               ->select('pemohons.*', 'permohonans.judul', 'status_permohonans.status')
               ->orderBy('created_at', 'DESC')
               ->paginate($this->perPage);
            //$pengajuan_permohonans = PengajuanPermohonan::orderBy('created_at', 'DESC')->paginate($this->perPage);
        }

        if($request->get('keyword')){
            $pengajuan_permohonan_users = PengajuanPermohonan::leftJoin('permohonans', 'pemohons.permohonan_id', '=', 'permohonans.id')
               ->leftJoin('status_permohonans', 'pemohons.id', '=', 'status_permohonans.pemohon_id')
               ->select('pemohons.*', 'permohonans.judul', 'status_permohonans.status')
               ->where('user_id', '=', Auth::user()->id)
               ->search($request->keyword)
               ->paginate($this->perPage);
        } else {
            $pengajuan_permohonan_users = PengajuanPermohonan::leftJoin('permohonans', 'pemohons.permohonan_id', '=', 'permohonans.id')
               ->leftJoin('status_permohonans', 'pemohons.id', '=', 'status_permohonans.pemohon_id')
               ->select('pemohons.*', 'permohonans.judul', 'status_permohonans.status')
               ->where('user_id', '=', Auth::user()->id)
               ->orderBy('created_at', 'DESC')
               ->paginate($this->perPage);
            //$pengajuan_permohonans = PengajuanPermohonan::orderBy('created_at', 'DESC')->paginate($this->perPage);
        }

        return view('pengajuan_permohonan.index', [
            'pengajuan_permohonans' => $pengajuan_permohonans->appends(['keyword' => $request->keyword]),
            'pengajuan_permohonan_users' => $pengajuan_permohonan_users->appends(['keyword' => $request->keyword]),
        ]);
    }

    public function select(Request $request)
    {
        $pengajuan_permohonan = [];
        if($request->has('q')){
            $pengajuan_permohonan = PengajuanPermohonan::select('id', 'nama_pemohon')->search($request->q)->get();
        }else{
            $pengajuan_permohonan = PengajuanPermohonan::select('id', 'nama_pemohon')->limit(5)->get();
        }

        return response()->json($pengajuan_permohonan);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengajuan_permohonan.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validation
        $validator = Validator::make(
            $request->all(),
            [
                  "permohonan" => "required",
                  "nama_pemohon" => "required|string|max:30",
                  "alamat_pemohon" => 'required',
                  "kecamatan_pemohon" => 'required',
                  "kota_pemohon" => 'required',
                  "provinsi_pemohon" => 'required',
                  "kode_pos_pemohon" => 'required|numeric',
                  "nama_perusahaan" => "required",
                  "alamat_perusahaan" => 'required',
                  "kecamatan_perusahaan" => 'required',
                  "kota_perusahaan" => 'required',
                  "provinsi_perusahaan" => 'required',
                  "kode_pos_perusahaan" => 'required|numeric',
                  "nama_objek" => 'required',
                  "lokasi_objek" => "required",
                  "dokumen_standar_teknis" => 'file|required|mimes:pdf|max:2560',
                  "bukti_kepemilikan" => 'file|required|mimes:pdf|max:2560',
                  "bukti_kesesuaian_tata_letak" => 'file|required|mimes:pdf|max:2560',
                  "foto_kondisi_lokasi" => 'image|file|required|max:2560'
            ],
        );

        if($validator->fails()){
            $request['permohonan'] = Permohonan::select('id', 'judul', 'jenis', 'ukuran')->find($request->permohonan);
            $request['provinsi_pemohon'] = Provinsi::select('id', 'nama')->find($request->provinsi_pemohon);
            $request['provinsi_perusahaan'] = Provinsi::select('id', 'nama')->find($request->provinsi_perusahaan);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        //Input Process
        DB::beginTransaction();
        try {
            $pengajuan_permohonan = PengajuanPermohonan::create([
                'user_id' => Auth::user()->id,
                'permohonan_id' => $request->permohonan,
                'nama_pemohon' => $request->nama_pemohon,
                'nama_perusahaan' => $request->nama_perusahaan,
                'nama_objek' => $request->nama_objek,
                'lokasi_objek' => $request->lokasi_objek
            ]);

            $bukti_permohonan = BuktiPermohonan::create([
                'pemohon_id' => $pengajuan_permohonan->id,
                'dokumen_standar_teknis' => $request->file('dokumen_standar_teknis')->store('bukti_permohonan'),
                'bukti_kepemilikan' => $request->file('bukti_kepemilikan')->store('bukti_permohonan'),
                'bukti_kesesuaian_tata_letak' => $request->file('bukti_kesesuaian_tata_letak')->store('bukti_permohonan'),
                'foto_kondisi_lokasi' => $request->file('foto_kondisi_lokasi')->store('bukti_permohonan')
            ]);

            $alamat_pemohon = AlamatPemohon::create([
                'pemohon_id' => $pengajuan_permohonan->id,
                'alamat_pemohon' => $request->alamat_pemohon,
                'kecamatan_pemohon' => $request->kecamatan_pemohon,
                'kota_pemohon' => $request->kota_pemohon,
                'provinsi_id' => $request->provinsi_pemohon,
                'kode_pos_pemohon' => $request->kode_pos_pemohon
            ]);

            $alamat_perusahaan = AlamatPerusahaan::create([
                'pemohon_id' => $pengajuan_permohonan->id,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'kecamatan_perusahaan' => $request->kecamatan_perusahaan,
                'kota_perusahaan' => $request->kota_perusahaan,
                'provinsi_id' => $request->provinsi_perusahaan,
                'kode_pos_perusahaan' => $request->kode_pos_perusahaan
            ]);

            $status_permohonan = StatusPermohonan::create([
                'pemohon_id' => $pengajuan_permohonan->id,
                'status' => $request->status,
            ]);

            Alert::success('Pengajuan Permohonan', 'Berhasil Disimpan!');
            return redirect()->route('pengajuan-permohonan.index');
        }catch (\Throwable $th){
            DB::rollBack();
            Alert::error('Tambah Pengajuan Permohonan', 'Error' . $th->getMessage());
            $request['permohonan'] = Permohonan::select('id', 'judul')->find($request->permohonan);
            $request['provinsi_pemohon'] = Provinsi::select('id', 'nama')->find($request->provinsi_pemohon);
            $request['provinsi_perusahaan'] = Provinsi::select('id', 'nama')->find($request->provinsi_perusahaan);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }finally{
            DB::commit();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function show(PengajuanPermohonan $pengajuan_permohonan)
    {
        $permohonan = $pengajuan_permohonan->permohonan;
        $bukti_permohonan = $pengajuan_permohonan->bukti_permohonan;
        $alamat_pemohon = $pengajuan_permohonan->alamat_pemohon;
        $alamat_perusahaan = $pengajuan_permohonan->alamat_perusahaan;
        $provinsi_pemohon = $pengajuan_permohonan->alamat_pemohon->provinsi;
        $provinsi_perusahaan = $pengajuan_permohonan->alamat_perusahaan->provinsi;

        return view('pengajuan_permohonan.detail', compact('pengajuan_permohonan', 'permohonan', 'bukti_permohonan', 'alamat_pemohon', 'alamat_perusahaan', 'provinsi_pemohon', 'provinsi_perusahaan'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function edit(PengajuanPermohonan $pengajuan_permohonan)
    {
        return view('pengajuan_permohonan.edit', [
            'pengajuan_permohonan' => $pengajuan_permohonan,
            'bukti_permohonan' => $pengajuan_permohonan->bukti_permohonan,
            'alamat_pemohon' => $pengajuan_permohonan->alamat_pemohon,
            'alamat_perusahaan' => $pengajuan_permohonan->alamat_perusahaan,
            'permohonanSelected' => $pengajuan_permohonan->permohonan,
            'provinsi_pemohonSelected' => $pengajuan_permohonan->alamat_pemohon->provinsi,
            'provinsi_perusahaanSelected' => $pengajuan_permohonan->alamat_perusahaan->provinsi,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PengajuanPermohonan $pengajuan_permohonan)
    {
        //validation
        $validator = Validator::make(
            $request->all(),
            [
                "permohonan" => "required",
                "nama_pemohon" => "required|string|max:30",
                "alamat_pemohon" => 'required',
                "kecamatan_pemohon" => 'required',
                "kota_pemohon" => 'required',
                "provinsi_pemohon" => 'required',
                "kode_pos_pemohon" => 'required|numeric',
                "nama_perusahaan" => "required",
                "alamat_perusahaan" => 'required',
                "kecamatan_perusahaan" => 'required',
                "kota_perusahaan" => 'required',
                "provinsi_perusahaan" => 'required',
                "kode_pos_perusahaan" => 'required|numeric',
                "nama_objek" => 'required',
                "lokasi_objek" => "required",
                "dokumen_standar_teknis" => 'file|mimes:pdf|max:2560',
                "bukti_kepemilikan" => 'file|mimes:pdf|max:2560',
                "bukti_kesesuaian_tata_letak" => 'file|mimes:pdf|max:2560',
                "foto_kondisi_lokasi" => 'image|file|max:2560'
            ],
        );

        if($validator->fails()){
            $request['permohonan'] = Permohonan::select('id', 'judul', 'panjang', 'lebar', 'jenis')->find($request->permohonan);
            $request['provinsi_pemohon'] = Provinsi::select('id', 'nama')->find($request->provinsi_pemohon);
            $request['provinsi_perusahaan'] = Provinsi::select('id', 'nama')->find($request->provinsi_perusahaan);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }

        DB::beginTransaction();
        try {
            $pengajuan_permohonan->update([
                'user_id' => Auth::user()->id,
                'permohonan_id' => $request->permohonan,
                'nama_pemohon' => $request->nama_pemohon,
                'nama_perusahaan' => $request->nama_perusahaan,
                'nama_objek' => $request->nama_objek,
                'lokasi_objek' => $request->lokasi_objek
            ]);

            if ($request->has(['dokumen_standar_teknis','bukti_kepemilikan','bukti_kesesuaian_tata_letak','foto_kondisi_lokasi']) ) {
                BuktiPermohonan::where('pemohon_id', $pengajuan_permohonan->id)->update([
                    'pemohon_id' => $pengajuan_permohonan->id,
                    'dokumen_standar_teknis' => $request->file('dokumen_standar_teknis')->store('bukti_permohonan'),
                    'bukti_kepemilikan' => $request->file('bukti_kepemilikan')->store('bukti_permohonan'),
                    'bukti_kesesuaian_tata_letak' => $request->file('bukti_kesesuaian_tata_letak')->store('bukti_permohonan'),
                    'foto_kondisi_lokasi' => $request->file('foto_kondisi_lokasi')->store('bukti_permohonan')
                ]);
            }


            AlamatPemohon::where('pemohon_id', $pengajuan_permohonan->id)->update([
                'pemohon_id' => $pengajuan_permohonan->id,
                'alamat_pemohon' => $request->alamat_pemohon,
                'kecamatan_pemohon' => $request->kecamatan_pemohon,
                'kota_pemohon' => $request->kota_pemohon,
                'provinsi_id' => $request->provinsi_pemohon,
                'kode_pos_pemohon' => $request->kode_pos_pemohon
            ]);

            AlamatPerusahaan::where('pemohon_id', $pengajuan_permohonan->id)->update([
                'pemohon_id' => $pengajuan_permohonan->id,
                'alamat_perusahaan' => $request->alamat_perusahaan,
                'kecamatan_perusahaan' => $request->kecamatan_perusahaan,
                'kota_perusahaan' => $request->kota_perusahaan,
                'provinsi_id' => $request->provinsi_perusahaan,
                'kode_pos_perusahaan' => $request->kode_pos_perusahaan
            ]);

            Alert::success('Pengajuan Permohonan', 'Berhasil Diubah!');
            return redirect()->route('pengajuan-permohonan.index');
        }catch (\Throwable $th){
            DB::rollBack();
            Alert::error('Edit Pengajuan Permohonan', 'Error' . $th->getMessage());
            $request['permohonan'] = Permohonan::select('id', 'judul')->find($request->permohonan);
            $request['provinsi_pemohon'] = Provinsi::select('id', 'nama')->find($request->provinsi_pemohon);
            $request['provinsi_perusahaan'] = Provinsi::select('id', 'nama')->find($request->provinsi_perusahaan);
            return redirect()->back()->withInput($request->all())->withErrors($validator);
        }finally{
            DB::commit();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Permohonan  $permohonan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengajuanPermohonan $pengajuan_permohonan)
    {
        DB::beginTransaction();
        try {
            $pengajuan_permohonan->delete();

            Alert::success('Pengajuan Permohonan', 'Berhasil Dihapus!');
            return redirect()->back();

        }catch (\Throwable $th){
            Alert::error('Hapus Pengajuan Permohonan', 'Error' . $th->getMessage());
            DB::rollBack();
        }finally{
            DB::commit();
            return redirect()->back();
        }
    }
}
