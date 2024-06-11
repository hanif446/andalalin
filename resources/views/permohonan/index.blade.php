@extends('layouts.dashboard')

@section('title')
  Data Permohonan
@endsection

@section('content')
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-8">
                  @can('data_permohonan_create')
                  <a href="{{route('data-permohonan.create')}}" class="btn bg-gradient-info btn-sm ms-auto"><i class="fas fa-plus"><b>&nbsp; Tambah Data</b></i></a>
                  @endcan
                </div>
                <div class="col-4">
                  <form action="{{route('data-permohonan.index')}}" method="GET">
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
              @if(count($permohonans))
              @foreach($permohonans as $permohonan)
              <ul class="list-group">
                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                    <h6 class="mb-3 text-sm">{{ $permohonan->judul }}</h6>
                    <span class="mb-2 text-xs">Jenis: <span class="text-dark font-weight-bold ms-sm-2">{{ $permohonan->jenis }}</span></span>
                    <span class="mb-2 text-xs">Ukuran: <span class="text-dark ms-sm-2 font-weight-bold">{{ $permohonan->ukuran }}</span></span>
                    <span class="text-xs">Kategori: <span class="text-dark ms-sm-2 font-weight-bold">{{ $permohonan->kategori }}</span></span>
                  </div>
                  <div class="ms-auto text-end">
                    @can('data_permohonan_delete')
                    <form class="d-inline" role="alert" action="{{route('data-permohonan.destroy',['data_permohonan' => $permohonan])}}" method="POST" alert-title = "Hapus Permohonan?" alert-text = "Apakah anda yakin ingin menghapus {{$permohonan->judul}} dari data permohonan?">
                      @csrf
                      @method('DELETE')
                        <button type="submit" class="btn btn-link text-danger text-gradient px-3 mb-0">
                          <i class="far fa-trash-alt me-2"></i>Delete
                        </button>
                    </form>
                    @endcan

                    @can('data_permohonan_update')
                    <a class="btn btn-link text-dark px-3 mb-0" href="{{ route('data-permohonan.edit', ['data_permohonan'=>$permohonan]) }}"><i class="fas fa-pencil-alt text-dark me-2" aria-hidden="true"></i>Edit</a>
                    @endcan
                  </div>
                </li>
              </ul>
              @endforeach
              @else
                <strong>
                  @if(request()->get('keyword'))
                    {{request()->get('keyword')}} Not Found in Permohonan
                    <br>
                    <br>
                  @else
                    Not Permohonan Data Yet
                    <br><br>
                  @endif
                </strong>

              @endif
             
            </div>
            @if ($permohonans->hasPages()) 
              <div class="card-footer">
                {{ $permohonans->links('vendor.pagination.bootstrap-5') }}
              </div>
            @else

            @endif
          </div>
        </div>
      </div>
@endsection

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
