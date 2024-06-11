<?php

namespace App\Http\Controllers;

use App\Models\Provinsi;
use Illuminate\Http\Request;

class ProvinsiController extends Controller
{
    public function select_pemohon(Request $request)
    {
        $provinsi_pemohon = [];

        if ($request->has('q')) {
            $search = $request->q;
            $provinsi_pemohon = Provinsi::select("id", "nama")
                ->Where('nama', 'LIKE', "%$search%")
                ->get();
        } else {
            $provinsi_pemohon = Provinsi::limit(10)->get();
        }
        return response()->json($provinsi_pemohon);
    }

    public function select_perusahaan(Request $request)
    {
        $provinsi_perusahaan = [];

        if ($request->has('q')) {
            $search = $request->q;
            $provinsi_perusahaan = Provinsi::select("id", "nama")
                ->Where('nama', 'LIKE', "%$search%")
                ->get();
        } else {
            $provinsi_perusahaan = Provinsi::limit(10)->get();
        }
        return response()->json($provinsi_perusahaan);
    }
}
