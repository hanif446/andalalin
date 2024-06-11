@extends('layouts.home')
@section('title')
  Home
@endsection
@section('content')
    <div class="jumbotron">
        <article>
            <h1>DISHUB KOTA TASIKMALAYA</h1>
            <br>
            <h3>"Membantu Walikota Melaksanakan Urusan Pemerintahan Daerah Dan Tugas Pembantuan Di Bidang Perhubungan"</h3>
            <h4> Jl. Ir. H. Juanda No. 191, Kelurahan Bantarsari, Kecamatan Bungursari, Kota Tasikmalaya, Jawa Barat 46151</h4>
        </article>
    </div>
    <div id="tentang-kami" class="main-content">
        <div class="flex-h">
            <article class="intro">
                <h1>Selamat datang di situs  ANDALALIN</h1>
                <p align="justify">ANDALALIN merupakan situs yang memberikan pelayanan dalam melakukan pengajuan permohonan perizinan. Dengan menggunakan situs ini pengajuan dapat dilakukan dengan cepat dan mudah.</p>
            </article>

            <div class="flex-h intro-img">
                <div class="img-container">
                    <img src="{{asset('template2/assets/img/gallery-4.jpeg')}}" class="featured-img">
                </div>
                <div class="img-container ml-50">
                    <img src="{{asset('template2/assets/img/gallery-8.jpeg')}}" class="featured-img">
                </div>
            </div>
        </div>
    </div>

    <div id="panduan" class="main-content bg-grey">
        <div class="title">
            <h1>Panduan Pengajuan Permohonan Perizinan</h1>
        </div>
        <div class="flex-v">
            <div class="flex-h mt-50 space-between">
                <div class="card flex-v">
                    <h1>1</h1>
                    <p>Registrasi Akun</p>
                </div>

                <div class="card flex-v">
                    <h1>2</h1>
                    <p>Pengajuan Permohonan</p>
                </div>

                <div class="card flex-v">
                    <h1>3</h1>
                    <p>Mengupload Semua Persyaratan</p>
                </div>

                <div class="card flex-v">
                    <h1>4</h1>
                    <p>Verifikasi Dokumen & Persyaratan</p>
                </div>
            </div>
        </div>
    </div>

@endsection