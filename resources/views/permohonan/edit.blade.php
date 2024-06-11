@extends('layouts.dashboard')

@section('title')
  Edit Data Permohonan
@endsection

@section('content')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <form method="post" action="{{route('data-permohonan.update', ['data_permohonan' => $data_permohonan])}}">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Judul</label>
                    <input class="form-control @error('judul') is-invalid @enderror" type="text" name="judul" value="{{old('judul', $data_permohonan->judul)}}" placeholder="Judul">
                    @error('judul')
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
                    <label for="example-text-input" class="form-control-label">Jenis</label>
                    <input class="form-control @error('jenis') is-invalid @enderror" type="text" name="jenis" value="{{old('jenis', $data_permohonan->jenis)}}" placeholder="Jenis">
                    @error('jenis')
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
                    <label for="example-text-input" class="form-control-label">Ukuran</label>
                    <input class="form-control @error('ukuran') is-invalid @enderror" type="text" name="ukuran" value="{{old('ukuran', $data_permohonan->ukuran)}}" placeholder="Ukuran">
                    @error('ukuran')
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
                    <label for="example-text-input" class="form-control-label">Kategori</label>
                    <input class="form-control @error('kategori') is-invalid @enderror" type="text" name="kategori" value="{{old('kategori', $data_permohonan->kategori)}}" placeholder="Kategori">
                    @error('kategori')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
                <a href="{{route('data-permohonan.index')}}" class="btn btn-warning px-4 mx-2">Batal</a>
                <button class="btn btn-info px-4" type="submit" name="simpan">Ubah</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection