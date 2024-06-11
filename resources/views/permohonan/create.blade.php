@extends('layouts.dashboard')

@section('title')
  Tambah Data Permohonan
@endsection

@section('content')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <form method="post" action="{{route('data-permohonan.store')}}">
            @csrf
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Judul</label>
                    <input class="form-control @error('judul') is-invalid @enderror" type="text" name="judul" value="{{old('judul')}}" placeholder="Judul">
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
                    <input class="form-control @error('jenis') is-invalid @enderror" type="text" name="jenis" value="{{old('jenis')}}" placeholder="Jenis">
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
                    <input class="form-control @error('ukuran') is-invalid @enderror" type="text" name="ukuran" value="{{old('ukuran')}}" placeholder="Ukuran">
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
                    <input class="form-control @error('kategori') is-invalid @enderror" type="text" name="kategori" value="{{old('kategori')}}" placeholder="Kategori">
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
                <button class="btn btn-success px-4" type="submit" name="simpan">Simpan</button>
            </div>
            </form>
          </div>
        </div>
      </div>
    </div>
@endsection