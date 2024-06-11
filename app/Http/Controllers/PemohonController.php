<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPermohonan;
use App\Models\StatusPermohonan;
use App\Models\AlamatPemohon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RealRashid\SweetAlert\Facades\Alert;

class PemohonController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:data_pemohon_show', ['only' => 'index']);
        $this->middleware('permission:data_pemohon_detail', ['only' => 'show']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $perPage = 10;

    public function index(Request $request)
    {
        $pemohons = [];

        if($request->get('keyword')){
            $pemohons = PengajuanPermohonan::leftJoin('permohonans', 'pemohons.permohonan_id', '=', 'permohonans.id')
               ->leftJoin('status_permohonans', 'pemohons.id', '=', 'status_permohonans.pemohon_id')
               ->select('pemohons.*', 'permohonans.judul', 'status_permohonans.status')
               ->search($request->keyword)
               ->paginate($this->perPage);
        } else {
            $pemohons = PengajuanPermohonan::leftJoin('permohonans', 'pemohons.permohonan_id', '=', 'permohonans.id')
               ->leftJoin('status_permohonans', 'pemohons.id', '=', 'status_permohonans.pemohon_id')
               ->select('pemohons.*', 'permohonans.judul', 'status_permohonans.status')
               ->orderBy('created_at', 'DESC')
               ->paginate($this->perPage);
        }

        return view('pemohon.index', [
            'pemohons' => $pemohons->appends(['keyword' => $request->keyword]),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\PengajuanPermohonan  $pengajuanPermohonan
     * @return \Illuminate\Http\Response
     */
    public function show(PengajuanPermohonan $data_pemohon)
    {
        $permohonan = $data_pemohon->permohonan;
        $bukti_permohonan = $data_pemohon->bukti_permohonan;
        $alamat_pemohon = $data_pemohon->alamat_pemohon;
        $alamat_perusahaan = $data_pemohon->alamat_perusahaan;
        $provinsi_pemohon = $data_pemohon->alamat_pemohon->provinsi;
        $provinsi_perusahaan = $data_pemohon->alamat_perusahaan->provinsi;

        return view('pemohon.detail', compact('data_pemohon', 'permohonan', 'bukti_permohonan', 'alamat_pemohon', 'alamat_perusahaan', 'provinsi_pemohon', 'provinsi_perusahaan'));
    }

    public function disetujui(PengajuanPermohonan $data_pemohon)
    {
        DB::beginTransaction();
        try {
            StatusPermohonan::where('pemohon_id', $data_pemohon->id)->update([
                'status' => 1,
            ]);

            Alert::success('Pengajuan Permohonan', 'Disetujui!');
            return redirect()->route('data-pemohon.index');
        }catch (\Throwable $th){
            DB::rollBack();
            Alert::error('Pengajuan Permohonan', 'Error' . $th->getMessage());
            return redirect()->back()->withInput($request->all());
        }finally{
            DB::commit();
        } 
    }

    public function tidak_disetujui(PengajuanPermohonan $data_pemohon)
    {
        DB::beginTransaction();
        try {
            StatusPermohonan::where('pemohon_id', $data_pemohon->id)->update([
                'status' => 2,
            ]);

            Alert::error('Pengajuan Permohonan', 'Tidak Disetujui!');
            return redirect()->route('data-pemohon.index');
        }catch (\Throwable $th){
            DB::rollBack();
            Alert::error('Pengajuan Permohonan', 'Error' . $th->getMessage());
            return redirect()->back()->withInput($request->all());
        }finally{
            DB::commit();
        } 
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PengajuanPermohonan  $pengajuanPermohonan
     * @return \Illuminate\Http\Response
     */
    public function edit(PengajuanPermohonan $pengajuanPermohonan)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\PengajuanPermohonan  $pengajuanPermohonan
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PengajuanPermohonan $pengajuanPermohonan)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PengajuanPermohonan  $pengajuanPermohonan
     * @return \Illuminate\Http\Response
     */
    public function destroy(PengajuanPermohonan $pengajuanPermohonan)
    {
        //
    }
}
