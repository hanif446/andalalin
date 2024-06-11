@extends('layouts.dashboard')

@section('title')
  Detail Data Pemohon
@endsection

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-6">
                  <br>
                  <h4>
                  <strong>Permohonan</strong>
                </h4>
                <hr class="horizontal block">
                  <div class="form-group">
                      <label class="font-weight-bold">
                           Judul
                      </label>
                      <label>:</label>
                      <label>{{ $permohonan->judul }}</label>
                      <br>
                      <label class="font-weight-bold">
                           Jenis
                      </label>
                      <label>:</label>
                      <label>{{ $permohonan->jenis }}</label>
                      <br>
                      <label class="font-weight-bold">
                           Ukuran
                      </label>
                      <label>:</label>
                      <label>{{ $permohonan->ukuran }}</label>
                      <br>
                      <label class="font-weight-bold">
                           Kategori
                      </label>
                      <label>:</label>
                      <label>{{ $permohonan->kategori }}</label>
                      <br>
                      <label class="font-weight-bold">
                           Nama Pemohon
                      </label>
                      <label>:</label>
                      <label>{{ $data_pemohon->nama_pemohon }}</label>
                      <br>
                      <label class="font-weight-bold">
                           Alamat Pemohon
                      </label>
                      <label>:</label>
                      <label>{{ $alamat_pemohon->alamat_pemohon }}, {{ $alamat_pemohon->kecamatan_pemohon }}, {{ $alamat_pemohon->kota_pemohon }}, {{ $provinsi_pemohon->nama }}, {{ $alamat_pemohon->kode_pos_pemohon }}</label>
                      <br>
                      <label class="font-weight-bold">
                           Nama Perusahaan
                      </label>
                      <label>:</label>
                      <label>{{ $data_pemohon->nama_perusahaan }}</label>
                      <br>
                      <label class="font-weight-bold">
                           Alamat Perusahaan
                      </label>
                      <label>:</label>
                      <label>{{ $alamat_perusahaan->alamat_perusahaan }}, {{ $alamat_perusahaan->kecamatan_perusahaan }}, {{ $alamat_perusahaan->kota_perusahaan }}, {{ $provinsi_perusahaan->nama }}, {{ $alamat_perusahaan->kode_pos_perusahaan }}</label>
                      <br>
                      <label class="font-weight-bold">
                           Nama Objek
                      </label>
                      <label>:</label>
                      <label>{{ $data_pemohon->nama_objek }}</label>
                      <br>
                      <label class="font-weight-bold">
                           Lokasi Objek
                      </label>
                      <label>:</label>
                      <label>{{ $data_pemohon->lokasi_objek }}</label>
                  </div>
                </div>
                <div class="col-md-6">
                  <br>
                  <h4>
                  <strong>Bukti Permohonan</strong>
                </h4>
                <hr class="horizontal block">
                  <div class="form-group">
                      <label class="font-weight-bold">
                           Dokumen Standar Teknis
                      </label>
                      <label>:</label>
                      <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><a href="{{ asset('storage/' .$bukti_permohonan->dokumen_standar_teknis) }}" style="font-size:13px;" target="_blank"><i class="fas fa-file-pdf text-lg me-1"></i>PDF</a> </button>
                      <br>
                      <label class="font-weight-bold">
                           Bukti Kepemilikan
                      </label>
                      <label>:</label>
                      <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><a href="{{ asset('storage/' .$bukti_permohonan->bukti_kepemilikan) }}" style="font-size:13px;" target="_blank"><i class="fas fa-file-pdf text-lg me-1"></i>PDF</a> </button>
                      <br>
                      <label class="font-weight-bold">
                           Bukti Kesesuaian Tata Letak
                      </label>
                      <label>:</label>
                      <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><a href="{{ asset('storage/' .$bukti_permohonan->bukti_kesesuaian_tata_letak) }}" style="font-size:13px;" target="_blank"><i class="fas fa-file-pdf text-lg me-1"></i>PDF</a> </button>
                      <br>
                      <label class="font-weight-bold">
                           Foto Kondisi Lokasi
                      </label>
                      <label>:</label>
                      <button class="btn btn-link text-dark text-sm mb-0 px-0 ms-4"><a href="{{ asset('storage/' .$bukti_permohonan->foto_kondisi_lokasi) }}" style="font-size:13px;" target="_blank"><i class="fas fa-image text-lg me-1"></i>Foto</a> </button>
                  </div>
                </div>
              </div>
              <div class="d-flex justify-content-end">
                <a href="{{ route('data-pemohon.index') }}" class="btn btn-warning mx-1" role="button">
                  Kembali
              </a>
              </div>
            </div>
         </div>
      </div>
    </div>
  </div>
@endsection