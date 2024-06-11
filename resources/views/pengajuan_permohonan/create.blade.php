@extends('layouts.dashboard')

@section('title')
  Tambah Pengajuan Permohonan
@endsection

@section('content')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <form method="post" action="{{route('pengajuan-permohonan.store')}}" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
              <h6>Pengajuan Permohonan</h6>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Permohonan</label>
                    <select id="select_permohonan" name="permohonan" data-placeholder="Pilih Permohonan" class="form-control @error('permohonan') is-invalid @enderror">
                      @if (old('permohonan'))
                        <option value="{{ old('permohonan')->id }}" selected>{{ old('permohonan')->judul }} - {{ old('permohonan')->jenis }} - {{ old('permohonan')->ukuran }}</option>
                      @endif
                     </select>
                    @error('permohonan')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama Pemohon</label>
                    <input class="form-control @error('nama_pemohon') is-invalid @enderror" type="text" name="nama_pemohon" value="{{old('nama_pemohon')}}" placeholder="Nama Pemohon">
                    @error('nama_pemohon')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <label>Alamat Pemohon :</label>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Alamat</label>
                    <input class="form-control @error('alamat_pemohon') is-invalid @enderror" type="text" name="alamat_pemohon" value="{{old('alamat_pemohon')}}" placeholder="Alamat">
                    @error('alamat_pemohon')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Kecamatan</label>
                    <input class="form-control @error('kecamatan_pemohon') is-invalid @enderror" type="text" name="kecamatan_pemohon" value="{{old('kecamatan_pemohon')}}" placeholder="Kecamatan">
                    @error('kecamatan_pemohon')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Kota</label>
                    <input class="form-control @error('kota_pemohon') is-invalid @enderror" type="text" name="kota_pemohon" value="{{old('kota_pemohon')}}" placeholder="Kota">
                    @error('kota_pemohon')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Provinsi</label>
                    <select id="select_provinsi_pemohon" name="provinsi_pemohon" data-placeholder="Pilih Provinsi" class="form-control @error('provinsi_pemohon') is-invalid @enderror">
                      @if (old('provinsi_pemohon'))
                        <option value="{{ old('provinsi_pemohon')->id }}" selected>{{ old('provinsi_pemohon')->nama }}</option>
                      @endif
                     </select>
                    @error('provinsi_pemohon')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Kode Pos</label>
                    <input class="form-control @error('kode_pos_pemohon') is-invalid @enderror" type="text" name="kode_pos_pemohon" value="{{old('kode_pos_pemohon')}}" placeholder="Kode Pos">
                    @error('kode_pos_pemohon')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama Perusahaan</label>
                    <input class="form-control @error('nama_perusahaan') is-invalid @enderror" type="text" name="nama_perusahaan" value="{{old('nama_perusahaan')}}" placeholder="Nama Perusahaan">
                    @error('nama_perusahaan')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <label>Alamat Perusahaan :</label>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Alamat</label>
                    <input class="form-control @error('alamat_perusahaan') is-invalid @enderror" type="text" name="alamat_perusahaan" value="{{old('alamat_perusahaan')}}" placeholder="Alamat">
                    @error('alamat_perusahaan')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Kecamatan</label>
                    <input class="form-control @error('kecamatan_perusahaan') is-invalid @enderror" type="text" name="kecamatan_perusahaan" value="{{old('kecamatan_perusahaan')}}" placeholder="Kecamatan">
                    @error('kecamatan_perusahaan')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Kota</label>
                    <input class="form-control @error('kota_perusahaan') is-invalid @enderror" type="text" name="kota_perusahaan" value="{{old('kota_perusahaan')}}" placeholder="Kota">
                    @error('kota_perusahaan')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Provinsi</label>
                    <select id="select_provinsi_perusahaan" name="provinsi_perusahaan" data-placeholder="Pilih Provinsi" class="form-control @error('provinsi_perusahaan') is-invalid @enderror">
                      @if (old('provinsi_perusahaan'))
                        <option value="{{ old('provinsi_perusahaan')->id }}" selected>{{ old('provinsi_perusahaan')->nama }}</option>
                      @endif
                     </select>
                    @error('provinsi_perusahaan')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Kode Pos</label>
                    <input class="form-control @error('kode_pos_perusahaan') is-invalid @enderror" type="text" name="kode_pos_perusahaan" value="{{old('kode_pos_perusahaan')}}" placeholder="Kode Pos">
                    @error('kode_pos_perusahaan')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama Objek</label>
                    <input class="form-control @error('nama_objek') is-invalid @enderror" type="text" name="nama_objek" value="{{old('nama_objek')}}" placeholder="Nama Objek">
                    @error('nama_objek')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Lokasi Objek</label>
                    <input class="form-control @error('lokasi_objek') is-invalid @enderror" type="text" name="lokasi_objek" value="{{old('lokasi_objek')}}" placeholder="Lokasi Objek">
                    @error('lokasi_objek')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <hr class="horizontal block">
              <h6>Bukti Permohonan</h6>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Dokumen Standar Teknis</label>
                    <input class="form-control @error('dokumen_standar_teknis') is-invalid @enderror" type="file" name="dokumen_standar_teknis" value="{{old('dokumen_standar_teknis')}}" placeholder="Dokumen Standar Teknis">
                    @error('dokumen_standar_teknis')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Bukti Kepemilikan</label>
                    <input class="form-control @error('bukti_kepemilikan') is-invalid @enderror" type="file" name="bukti_kepemilikan" value="{{old('bukti_kepemilikan')}}" placeholder="Bukti Kepemilikan">
                    @error('bukti_kepemilikan')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Bukti Kesesuaian Tata Letak</label>
                    <input class="form-control @error('bukti_kesesuaian_tata_letak') is-invalid @enderror" type="file" name="bukti_kesesuaian_tata_letak" value="{{old('bukti_kesesuaian_tata_letak')}}" placeholder="Bukti Kesesuaian Tata Letak">
                    @error('bukti_kesesuaian_tata_letak')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Foto Kondisi Lokasi</label>
                    <input class="form-control @error('foto_kondisi_lokasi') is-invalid @enderror" type="file" name="foto_kondisi_lokasi" value="{{old('foto_kondisi_lokasi')}}" placeholder="Foto Kondisi Lokasi">
                    @error('foto_kondisi_lokasi')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <input class="form-control" type="hidden" name="status" value="0" placeholder="Status Pemohon">
              <hr class="horizontal dark">
                <a href="{{route('pengajuan-permohonan.index')}}" class="btn btn-warning px-4 mx-2">Batal</a>
                <button class="btn btn-success px-4" type="submit" name="simpan">Simpan</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection

@push('css-external')
    <link rel="stylesheet" href="{{asset('template/select2/css/select2.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/select2/css/select2-bootstrap5.min.css')}}">
@endpush

@push('javascript-external')
    <script src="{{asset('template/select2/js/select2.min.js')}}"></script>
@endpush

@push('javascript-internal')
        <script>
            $(function (){

              $('#select_provinsi_pemohon').select2({
                  theme: 'bootstrap5',
                allowClear: true,
                ajax: {
                   url: "{{ route('provinsi.select_pemohon') }}",
                   dataType: 'json',
                   delay: 250,
                   processResults: function(data) {
                      return {
                         results: $.map(data, function(item) {
                            return {
                               text: item.nama,
                               id: item.id
                            }
                         })
                      };
                   }
                }
              });

              $('#select_provinsi_perusahaan').select2({
                  theme: 'bootstrap5',
                allowClear: true,
                ajax: {
                   url: "{{ route('provinsi.select_perusahaan') }}",
                   dataType: 'json',
                   delay: 250,
                   processResults: function(data) {
                      return {
                         results: $.map(data, function(item) {
                            return {
                               text: item.nama,
                               id: item.id
                            }
                         })
                      };
                   }
                }
              });

              $('#select_permohonan').select2({
                  theme: 'bootstrap5',
                allowClear: true,
                ajax: {
                   url: "{{ route('data-permohonan.select') }}",
                   dataType: 'json',
                   delay: 250,
                   processResults: function(data) {
                      return {
                         results: $.map(data, function(item) {
                            return {
                               text:[item.judul+ " - "+ item.jenis+ " - "+ item.ukuran],
                               id: item.id
                            }
                         })
                      };
                   }
                }
              });

            });
        </script>
@endpush
