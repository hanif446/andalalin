@extends('layouts.dashboard')

@section('title')
  Users
@endsection

@section('content')
<div class="container-fluid py-4">
  <div class="row">
     <div class="col-md-12">
        <div class="card">
           <div class="card-header">
              <div class="row">
                <div class="col-8">
                @can('user_create')
                  <a href="{{route('users.create')}}" class="btn bg-gradient-info btn-sm ms-auto"><i class="fas fa-plus"><b>&nbsp; Tambah Data</b></i></a>
                @endcan
                </div>
                <div class="col-md-4">
                    <form action="" method="GET">
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
              <div class="row">
                 <!-- list users -->
                @forelse ($users as $user)
                <div class="col-md-6">
                 <div class="card mx-1 my-2">
                    <div class="card-body">
                       <div class="row">
                          <div class="col-md-2">
                             <i class="fas fa-id-badge fa-5x"></i>
                          </div>
                      <div class="col-md-10">
                         <table>
                            <tr>
                               <th>
                                  Nama User
                               </th>
                               <td>:</td>
                               <td>
                                  {{ $user->nama_user }}
                               </td>
                            </tr>
                            <tr>
                               <th>
                                  Email
                               </th>
                               <td>:</td>
                               <td>
                                  {{ $user->email }}
                               </td>
                            </tr>
                            <tr>
                               <th>
                                  Role
                               </th>
                               <td>:</td>
                               <td>
                                  {{ $user->roles->first()->name }}
                               </td>
                            </tr>
                         </table>
                      </div>
                   </div>
                   <div class="float-end">
                    <!-- detail -->
                    @can('user_detail')
                      <a href="{{ route('users.show', ['user' => $user]) }}" class="badge badge-sm bg-gradient-warning" role="button">
                          <i class="fas fa-eye"></i>
                      </a>
                    @endcan

                    @can('user_update')
                      <!-- edit -->
                      <a href="{{route('users.edit', ['user' => $user])}}" class="badge badge-sm bg-gradient-success" role="button">
                          <i class="fas fa-edit"></i>
                      </a>
                    @endcan
                      <!-- delete -->
                    @can('user_delete')
                      <form class="d-inline" role="alert" action="{{route('users.destroy',['user' => $user])}}"method="POST" alert-title = "Hapus User?" alert-text = "Apakah anda yakin ingin menghapus {{$user->nama_user}} dari user?">
                        @csrf
                        @method('DELETE')
                          <button type="submit" class="badge badge-sm bg-gradient-danger" style="border: 0;">
                            <i class="fas fa-trash"></i>
                          </button>
                      </form>
                    @endcan
                   </div>
                </div>
             </div>
          </div>
                 @empty
                    <p>
                      <strong>
                        @if (request()->get('keyword'))
                           {{request()->get('keyword')}} Not Found in User
                          @else
                            No Users Data Yet
                          @endif
                      </strong>
                    </p>
                 @endforelse
              </div>
           </div>
           @if ($users->hasPages())
             <div class="card-footer">
                {{$users->links('vendor.pagination.bootstrap-5')}}
             </div>
           @endif
        </div>
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
