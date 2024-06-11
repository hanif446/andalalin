@extends('layouts.dashboard')

@section('title')
  Roles
@endsection

@section('content')
  <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-8">
                  @can('role_create')
                  <a href="{{route('roles.create')}}" class="btn bg-gradient-info btn-sm ms-auto"><i class="fas fa-plus"><b>&nbsp; Tambah Data</b></i></a>
                  @endcan
                </div>
                <div class="col-4">
                  <form action="{{route('roles.index')}}" method="GET">
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
              
             <div class="table-responsive p-0">
                <table class="table align-items-center mb-0" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">No</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Roles</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no = 1; @endphp
                    @forelse ($roles as $role)
                    <tr>
                      <td class="align-middle text-center">
                         <p class="text-xs font-weight-bold mb-0">{{ $no++ }}</p>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $role->name }}</p>
                      </td>
                      <td class="align-middle text-center">
                        @can('role_detail')
                        <a href="{{ route('roles.show', ['role'=> $role ]) }}" title="Detail" class="badge badge-sm bg-gradient-warning">
                            <i class="fas fa-eye"></i>
                        </a>
                        @endcan
                        @can('role_update')
                        <a href="{{ route('roles.edit', ['role'=> $role ]) }}" title="Ubah" class="badge badge-sm bg-gradient-success">
                            <i class="fas fa-edit"></i>
                        </a>
                        @endcan
                        @can('role_delete')
                        <form class="d-inline" role="alert" action="{{route('roles.destroy',['role' => $role])}}"method="POST" alert-title = "Hapus Role?" alert-text = "Apakah anda yakin ingin menghapus {{$role->name}} dari role?">
                          @csrf
                          @method('DELETE')
                            <button type="submit" class="delete-link badge badge-sm bg-gradient-danger" style="border: 0;">
                              <i class="fas fa-trash"></i>
                            </button>
                        </form>
                        @endcan
                      </td>
                    </tr>
                    @empty
                    <p>
                      <strong>
                        @if (request()->get('keyword'))
                         {{request()->get('keyword')}} Not Found in Role
                        @else
                          No Roles Data Yet
                        @endif
                      </strong>
                    </p>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
            @if ($roles->hasPages())
             <div class="card-footer">
                {{$roles->links('vendor.pagination.bootstrap-5')}}
             </div>
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