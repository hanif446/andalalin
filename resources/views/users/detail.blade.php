@extends('layouts.dashboard')

@section('title')
  Detail User
@endsection

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
      <div class="col-md-12">
         <div class="card">
            <div class="card-body">
              <div class="row">
                <div class="col-md-5">
                  <br>
                  <h4>
                  <strong>Data User</strong>
                </h4>
                <hr class="horizontal block">
                  <div class="form-group">
                      <label class="font-weight-bold">
                           Nama User
                      </label>
                      <label>:</label>
                      <label>{{ $user->nama_user }}</label>
                  </div>
                  <div class="form-group">
                      <label class="font-weight-bold">
                           Jenis Kelamin
                      </label>
                      <label>:</label>
                      <label>
                        @if ($user->jk == 'L')
                          Laki-Laki
                        @else
                          Perempuan
                        @endif
                      </label>
                  </div>
                  <div class="form-group">
                      <label class="font-weight-bold">
                           Tempat Lahir
                      </label>
                      <label>:</label>
                      <label>{{ $user->tempat_lahir }}</label>  
                  </div>
                  <div class="form-group">
                      <label class="font-weight-bold">
                           Tanggal Lahir
                      </label>
                      <label>:</label>
                      <label>{{ $user->tgl_lahir }}</label>
                  </div>
                  <div class="form-group">
                      <label class="font-weight-bold">
                           No Handphone
                      </label>
                      <label>:</label>
                      <label>{{ $user->no_hp}}</label>  
                  </div>
                  <div class="form-group">
                      <label class="font-weight-bold">
                           Email
                      </label>
                      <label>:</label>
                      <label>{{ $user->email }}</label>  
                  </div>
              </div>
          </div>

               <div class="d-flex justify-content-end">
                  <a href="{{ route('users.index') }}" class="btn btn-warning mx-1" role="button">
                     Kembali
                  </a>
               </div>
            </div>
         </div>
      </div>
   </div>
 </div>
@endsection