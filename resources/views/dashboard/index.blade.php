@extends('layouts.dashboard')

@section('title')
  Halaman Utama Dashboard
@endsection
@if (Auth::user()->roles->first()->name == 'User')
  @section('content')
    <div class="container-fluid py-4">
        <div class="row">
          <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Jumlah Pengajuan Permohonan</p>
                      <br>
                      <p class="mb-0">
                        <span class="text-dark text-sm font-weight-bolder">Total : </span>
                        {{ $pengajuan_permohonan }}
                      </p>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-warning shadow-primary text-center rounded-circle">
                      <i class="ni ni-archive-2 text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Permohonan yang Disetujui</p>
                      <br>
                      <p class="mb-0">
                        <span class="text-dark text-sm font-weight-bolder">Total : </span>
                          {{ $disetujui}}
                      </p>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-success shadow-danger text-center rounded-circle">
                      <i class="fas fa-check text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Permohonan yang tidak Disetujui</p>
                      <br>
                      <p class="mb-0">
                        <span class="text-dark text-sm font-weight-bolder">Total : </span>
                          {{ $tidak_disetujui}}
                      </p>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-danger shadow-success text-center rounded-circle">
                      <i class="fa fa-remove text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
              <div class="card-header pb-0 pt-3 bg-transparent">
                <p class="text-sm mb-0" align="center">
                  <img src="{{asset('template/img/dishub.png')}}" width="125" height="150">
                  <h5 class="text-capitalize" align="center">Aplikasi Andalalin</h5>
                  <br>
                  <!--<small><center>Aplikasi Andalalin ini dibuat untuk mendokumentasikan proses permohonan perizinan suatu kegiatan atau sebuah usaha. Aplikasi ini sangat mudah digunakan (Berbasis Web) dan dibuat sesuai dengan kebutuhan.</center></small>-->

                  <h6><marquee direction="left"><b>Selamat Datang {{Auth::user()->roles->first()->name}}</marquee></b></h6>
                  <p><marquee direction="left"><b>Semoga harimu menyenangkan &#x1F609;</marquee></b></p>
                  
                </p>
              </div>
            </div>
          </div>
        </div>
  @endsection
@else
  @section('content')
      <div class="container-fluid py-4">
        <div class="row">
          <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Data User</p>
                      <br>
                      <p class="mb-0">
                        <span class="text-dark text-sm font-weight-bolder">Total : </span>
                        {{ $users }}
                      </p>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-warning shadow-primary text-center rounded-circle">
                      <i class="fas fa-fw fa-users text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Data Permohonan</p>
                      <br>
                      <p class="mb-0">
                        <span class="text-dark text-sm font-weight-bolder">Total : </span>
                        {{ $permohonans }}
                      </p>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-success shadow-danger text-center rounded-circle">
                      <i class="ni ni-credit-card text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xl-4 col-sm-6 mb-xl-0 mb-4">
            <div class="card">
              <div class="card-body p-4">
                <div class="row">
                  <div class="col-8">
                    <div class="numbers">
                      <p class="text-sm mb-0 text-uppercase font-weight-bold">Data Pemohon</p>
                      <br>
                      <p class="mb-0">
                        <span class="text-dark text-sm font-weight-bolder">Total : </span>
                        {{ $pemohons }}
                      </p>
                    </div>
                  </div>
                  <div class="col-4 text-end">
                    <div class="icon icon-shape bg-gradient-info shadow-success text-center rounded-circle">
                      <i class="ni ni-app text-lg opacity-10" aria-hidden="true"></i>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="row mt-4">
          <div class="col-lg-12 mb-lg-0 mb-4">
            <div class="card z-index-2 h-100">
              <div class="card-header pb-0 pt-3 bg-transparent">
                <p class="text-sm mb-0" align="center">
                  <img src="{{asset('template/img/dishub.png')}}" width="125" height="150">
                  <h5 class="text-capitalize" align="center">Aplikasi Andalalin</h5>
                  <br>
                  <!--<small><center>Aplikasi Andalalin ini dibuat untuk mendokumentasikan proses permohonan perizinan suatu kegiatan atau sebuah usaha. Aplikasi ini sangat mudah digunakan (Berbasis Web) dan dibuat sesuai dengan kebutuhan.</center></small>-->

                  <h6><marquee direction="left"><b>Selamat Datang {{Auth::user()->roles->first()->name}}</marquee></b></h6>
                  <p><marquee direction="left"><b>Semoga harimu menyenangkan &#x1F609;</marquee></b></p>
                  
                </p>
              </div>
            </div>
          </div>
        </div>
  @endsection
@endif