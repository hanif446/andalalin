<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
      $users = DB::table('users')->count();
      $permohonans = DB::table('permohonans')->count();
      $pemohons = DB::table('pemohons')->count();
      $pengajuan_permohonan = DB::table('pemohons')->where('user_id', '=', Auth::user()->id)->count();
      $disetujui = DB::table('status_permohonans')->join('pemohons', 'status_permohonans.pemohon_id', '=', 'pemohons.id')->where('status', '=', 1)->where('user_id', '=', Auth::user()->id)->count();
      $tidak_disetujui = DB::table('status_permohonans')->join('pemohons', 'status_permohonans.pemohon_id', '=', 'pemohons.id')->where('status', '=', 2)->where('user_id', '=', Auth::user()->id)->count();
      return view('dashboard.index', [
         'users' => $users,
         'permohonans' => $permohonans,
         'pemohons' => $pemohons,
         'pengajuan_permohonan' => $pengajuan_permohonan,
         'disetujui' => $disetujui,
         'tidak_disetujui' => $tidak_disetujui
      ]); 
    }
}
