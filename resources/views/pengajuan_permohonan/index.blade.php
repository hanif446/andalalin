@extends('layouts.dashboard')

@section('title')
  Pengajuan Permohonan
@endsection

@if (Auth::user()->roles->first()->name == 'User')
@section('content')
  <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-8">
                  @can('pengajuan_permohonan_create')
                  <a href="{{route('pengajuan-permohonan.create')}}" class="btn bg-gradient-info btn-sm ms-auto"><i class="fas fa-plus"><b>&nbsp; Tambah Data</b></i></a>
                  @endcan
                </div>
                <div class="col-4">
                  <form action="{{route('pengajuan-permohonan.index')}}" method="GET">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                      <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input name="keyword" type="search" class="form-control" value="{{request()->get('keyword')}}" placeholder="Type here...">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-body">
              @if(count($pengajuan_permohonan_users))
              @foreach($pengajuan_permohonan_users as $pengajuan_permohonan_user)
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">{{ $pengajuan_permohonan_user->judul }}</h6>
                    <span class="mb-2 text-xs">Nama Pemohon: <span class="text-dark font-weight-bold ms-sm-2">{{ $pengajuan_permohonan_user->nama_pemohon }}</span></span>
                    <span class="mb-2 text-xs">Nama Perusahaan: <span class="text-dark ms-sm-2 font-weight-bold">{{ $pengajuan_permohonan_user->nama_perusahaan }}</span></span>
                    <span class="mb-2 text-xs">Nama Objek: <span class="text-dark ms-sm-2 font-weight-bold">{{ $pengajuan_permohonan_user->nama_objek }}</span></span>
                    <span class="text-xs">Lokasi Objek: <span class="text-dark ms-sm-2 font-weight-bold">{{ $pengajuan_permohonan_user->lokasi_objek }}</span></span>
                    <br>
                    @if ($pengajuan_permohonan_user->status == '0')
                      <span class="badge badge-sm bg-gradient-warning">Belum Disetujui</span>
                    @elseif ($pengajuan_permohonan_user->status == '1')
                      <span class="badge badge-sm bg-gradient-success">Disetujui</span>
                    @else
                      <span class="badge badge-sm bg-gradient-danger">Tidak Disetujui</span>
                    @endif
                  </div>
                  <div class="ms-auto text-end">
                    @can('pengajuan_permohonan_delete')
                    <form class="d-inline" role="alert" action="{{route('pengajuan-permohonan.destroy',['pengajuan_permohonan' => $pengajuan_permohonan_user])}}" method="POST" alert-title = "Hapus Pengajuan Permohonan?" alert-text = "Apakah anda yakin ingin menghapus {{$pengajuan_permohonan_user->nama_pemohon}} dari data pengajuan permohonan?">
                      @csrf
                      @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0">
                          <i class="far fa-trash-alt me-2"></i>Delete
                        </button>
                    </form>
                    @endcan

                    @can('pengajuan_permohonan_update')
                    <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('pengajuan-permohonan.edit', ['pengajuan_permohonan'=>$pengajuan_permohonan_user]) }}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                    @endcan
                    
                    @can('pengajuan_permohonan_detail')
                    <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('pengajuan-permohonan.show', ['pengajuan_permohonan'=>$pengajuan_permohonan_user]) }}"><i class="fas fa-eye text-dark me-2" aria-hidden="true"></i>Detail</a>
                    @endcan
                  </div>
                </li>
              </ul>
              @endforeach
              @else
                <strong>
                  @if(request()->get('keyword'))
                    {{request()->get('keyword')}} Not Found in Pengajuan Permohonan
                    <br>
                    <br>
                  @else
                    Not Pengajuan Permohonan Data Yet
                    <br><br>
                  @endif
                </strong>

              @endif
             
            </div>
            @if ($pengajuan_permohonan_users->hasPages()) 
              <div class="card-footer">
                {{ $pengajuan_permohonan_users->links('vendor.pagination.bootstrap-5') }}
              </div>
            @else

            @endif
            
          </div>
        </div>
      </div>
@endsection
@else
  @section('content')
  <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-8">
                  @can('pengajuan_permohonan_create')
                  <a href="{{route('pengajuan-permohonan.create')}}" class="btn bg-gradient-info btn-sm ms-auto"><i class="fas fa-plus"><b>&nbsp; Tambah Data</b></i></a>
                  @endcan
                </div>
                <div class="col-4">
                  <form action="{{route('pengajuan-permohonan.index')}}" method="GET">
                    <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                      <div class="input-group">
                        <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                        <input name="keyword" type="search" class="form-control" value="{{request()->get('keyword')}}" placeholder="Type here...">
                      </div>
                    </div>
                  </form>
                </div>
              </div>
            </div>
            <div class="card-body">
              @if(count($pengajuan_permohonans))
              @foreach($pengajuan_permohonans as $pengajuan_permohonan)
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">{{ $pengajuan_permohonan->judul }}</h6>
                    <span class="mb-2 text-xs">Nama Pemohon: <span class="text-dark font-weight-bold ms-sm-2">{{ $pengajuan_permohonan->nama_pemohon }}</span></span>
                    <span class="mb-2 text-xs">Nama Perusahaan: <span class="text-dark ms-sm-2 font-weight-bold">{{ $pengajuan_permohonan->nama_perusahaan }}</span></span>
                    <span class="mb-2 text-xs">Nama Objek: <span class="text-dark ms-sm-2 font-weight-bold">{{ $pengajuan_permohonan->nama_objek }}</span></span>
                    <span class="text-xs">Lokasi Objek: <span class="text-dark ms-sm-2 font-weight-bold">{{ $pengajuan_permohonan->lokasi_objek }}</span></span>
                    <br>
                    @if ($pengajuan_permohonan->status == '0')
                      <span class="badge badge-sm bg-gradient-warning">Belum Disetujui</span>
                    @elseif ($pengajuan_permohonan->status == '1')
                      <span class="badge badge-sm bg-gradient-success">Disetujui</span>
                    @else
                      <span class="badge badge-sm bg-gradient-danger">Tidak Disetujui</span>
                    @endif
                  </div>
                  <div class="ms-auto text-end">
                    @can('pengajuan_permohonan_delete')
                    <form class="d-inline" role="alert" action="{{route('pengajuan-permohonan.destroy',['pengajuan_permohonan' => $pengajuan_permohonan])}}" method="POST" alert-title = "Hapus Pengajuan Permohonan?" alert-text = "Apakah anda yakin ingin menghapus {{$pengajuan_permohonan->nama_pemohon}} dari data pengajuan permohonan?">
                      @csrf
                      @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0">
                          <i class="far fa-trash-alt me-2"></i>Delete
                        </button>
                    </form>
                    @endcan

                    @can('pengajuan_permohonan_update')
                    <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('pengajuan-permohonan.edit', ['pengajuan_permohonan'=>$pengajuan_permohonan]) }}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                    @endcan
                    
                    @can('pengajuan_permohonan_detail')
                    <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('pengajuan-permohonan.show', ['pengajuan_permohonan'=>$pengajuan_permohonan]) }}"><i class="fas fa-eye text-dark me-2" aria-hidden="true"></i>Detail</a>
                    @endcan
                  </div>
                </li>
              </ul>
              @endforeach
              @else
                <strong>
                  @if(request()->get('keyword'))
                    {{request()->get('keyword')}} Not Found in Pengajuan Permohonan
                    <br>
                    <br>
                  @else
                    Not Pengajuan Permohonan Data Yet
                    <br><br>
                  @endif
                </strong>

              @endif
             
            </div>
            @if ($pengajuan_permohonans->hasPages()) 
              <div class="card-footer">
                {{ $pengajuan_permohonans->links('vendor.pagination.bootstrap-5') }}
              </div>
            @else

            @endif
            
          </div>
        </div>
      </div>
@endsection
@endif

@push('javascript-internal')
    <script>
        $(document).ready(function () {
            $("form[role='alert']").submit(function (event){
                event.preventDefault();
                Swal.fire({
                    title: $(this).attr('alert-title'),
                    text: $(this).attr('alert-text'),
                    icon: 'warning',
                    allowOutsideClick: true,
                    showCancelButton: true,
                    cancelButtonText: "Cancel",
                    reverseButtons: true,
                    confirmButtonText: "Yes",
                }).then((result) => {
                    if (result.isConfirmed) {
                        event.target.submit();
                    }
                });

            })
        })
    </script>
@endpush
