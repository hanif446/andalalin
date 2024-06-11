@extends('layouts.dashboard')

@section('title')
  Edit Profil
@endsection

@section('content')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-md-12">
          <div class="card">
            <form method="post" action="{{ route('users.update_profil', ['user' => $user]) }}">
            @csrf
            @method('PUT')
            <div class="card-body">
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Nama User</label>
                    <input class="form-control @error('nama_user') is-invalid @enderror" type="text" name="nama_user" value="{{old('nama_user', $user->nama_user)}}" placeholder="Nama User">
                    @error('nama_user')
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
                    <label for="example-text-input" class="form-control-label">Jenis Kelamin</label>
                    <select id="select_user_gender" name="jk" data-placeholder="Pilih Jenis Kelamin" class="form-control @error('jk') is-invalid @enderror">
                      @foreach ($genders as $key => $value)
                        <option value="{{ $key }}" {{ old('jk', $user->jk) == $key ? "selected" : null}}>{{ $value }}</option>
                      @endforeach
                    </select>
                    @error('jk')
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
                    <label for="example-text-input" class="form-control-label">Tempat Lahir</label>
                    <input class="form-control @error('tempat_lahir') is-invalid @enderror" type="text" name="tempat_lahir" value="{{old('tempat_lahir', $user->tempat_lahir)}}" placeholder="Tempat Lahir">
                    @error('tempat_lahir')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="example-text-input" class="form-control-label">Tanggal Lahir</label>
                    <input class="form-control @error('tgl_lahir') is-invalid @enderror" type="date" name="tgl_lahir" value="{{old('tgl_lahir', $user->tgl_lahir)}}" placeholder="Jenis Kelamin">
                    @error('tgl_lahir')
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
                    <label for="example-text-input" class="form-control-label">No Handphone</label>
                    <input class="form-control @error('no_hp') is-invalid @enderror" type="text" name="no_hp" value="{{old('no_hp', $user->no_hp)}}" placeholder="No Handphone">
                    @error('no_hp')
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
                    <label for="example-text-input" class="form-control-label">Email</label>
                    <input class="form-control @error('email') is-invalid @enderror" type="email" name="email" value="{{old('email', $user->email)}}" placeholder="Email">
                    @error('email')
                      <span class="invalid-feedback">
                        <strong>{{$message}}</strong>
                      </span>
                    @enderror
                  </div>
                </div>
              </div>
              <hr class="horizontal dark">
                <a href="{{route('users.index')}}" class="btn btn-warning px-4 mx-2">Batal</a>
                <button class="btn btn-info px-4" type="submit" name="ubah">Ubah</button>
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
                
                //select role users
                $('#select_user_role').select2({
                    theme: 'bootstrap5',
                    language: "",
                    allowClear: true,
                    ajax: {
                        url: "{{route('roles.select')}}",
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data, function(item) {
                                    return {
                                        text: item.name,
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
