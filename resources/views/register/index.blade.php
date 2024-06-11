@extends('layouts.register')

@section('title')
  Sign Up
@endsection

@section('content')
  <div class="page-header align-items-start min-vh-50 pt-5 pb-11 m-3 border-radius-lg" style="background-image: url('{{ asset('template2/assets/img/traffic-3.jpg') }}'); background-position: top;">
      <span class="mask bg-gradient-dark opacity-6"></span>
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-lg-5 text-center mx-auto">
            <h1 class="text-white mb-2 mt-5">Welcome!</h1>
            <p class="text-lead text-white">Use these forms to create new account.</p>
          </div>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row mt-lg-n10 mt-md-n11 mt-n10 justify-content-center">
        <div class="col-xl-4 col-lg-5 col-md-7 mx-auto">
          <div class="card z-index-0">
            <div class="card-header text-center pt-4">
              <h5>Sign Up</h5>
            </div>
            
            <div class="card-body">
              <form method="POST" action="{{route('sign-up.store')}}">
                @csrf
                <div class="mb-3">
                  <input type="text" class="form-control @error('nama_user') is-invalid @enderror" placeholder="Nama Lengkap" aria-label="Nama Lengkap" name="nama_user" value="{{old('nama_user')}}">
                  @error('nama_user')
                    <span class="invalid-feedback">
                      <strong>{{$message}}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{old('email')}}" placeholder="Email" aria-label="Email">
                  @error('email')
                    <span class="invalid-feedback">
                      <strong>{{$message}}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{old('password')}}" placeholder="Password" aria-label="Password">
                  @error('password')
                    <span class="invalid-feedback">
                      <strong>{{$message}}</strong>
                    </span>
                  @enderror
                </div>
                <div class="mb-3">
                  <input type="password" class="form-control" name="password_confirmation" placeholder="Konfirmasi Password" aria-label="Konfirmasi Password" autocomplete="new-password">
                </div>
                <div class="mb-3">
                  <input id="role" type="hidden" class="form-control" name="role" value="3">
                </div>
                <div class="text-center">
                  <button type="submit" class="btn bg-gradient-dark w-100 my-4 mb-2">Sign up</button>
                </div>
                <p class="text-sm mt-3 mb-0">Already have an account? <a href="{{ route('login') }}" class="text-dark font-weight-bolder">Sign in</a></p>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
@endsection