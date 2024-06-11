@extends('layouts.dashboard')

@section('title')
  Edit Role
@endsection

@section('content')
  <div class="container-fluid py-4">
    <div class="row">
       <div class="col-md-12">
          <div class="card">
             <form action="{{ route('roles.update', ['role' => $role]) }}" method="POST">
              @csrf
              @method('PUT')
                <div class="card-body">
                   <div class="form-group">
                      <label for="input_role_name" class="font-weight-bold">
                         Nama Role
                      </label>
                      <input id="input_role_name" value="{{ old('name', $role->name) }}" name="name" type="text" class="form-control @error ('name')is-invalid  @enderror" placeholder="Nama Role" />
                      @error ('name')
                        <span class="invalid-feedback">
                          <strong>
                            {{ $message }}
                          </strong>
                        </span> 
                      @enderror
                   </div>
                   <!-- permission -->
                   <div class="form-group">
                      <label for="input_role_permission" class="font-weight-bold">
                         Permission
                      </label>
                      <div class="form-control overflow-auto h-100 @error ('permission')is-invalid  @enderror" id="input_role_permission">
                         <div class="row">
                            <!-- list manage name:start -->
                @foreach ($authorities as $manageName => $permissions)
                  <ul class="list-group mx-1 my-2" style="font-size:15px;width: 220px;">
                     <li class="list-group-item bg-dark text-white">
                         <center>{{trans("permissions.{$manageName}")}}</center>
                     </li>
                     <!-- list permission:start -->
                     @foreach ($permissions as $permission)
                        <li class="list-group-item">
                           <div class="form-check">
                              @if (old('permissions', $permissionChecked))
                                 <input id="{{ $permission }}" name="permissions[]" class="form-check-input" type="checkbox" value="{{$permission}}" {{ in_array($permission, old('permissions', $permissionChecked)) ? "checked" : null}}>
                              @else
                                 <input id="{{ $permission }}" name="permissions[]" class="form-check-input" type="checkbox" value="{{$permission}}">
                              @endif
                                         
                                 <label for="{{ $permission }}" class="form-check-label">
                                    {{trans("permissions.{$permission}")}}
                                 </label>
                           </div>
                        </li>
                     @endforeach
                                
                     <!-- list permission:end -->
                  </ul>
                @endforeach

                            
               <!-- list manage name:end  -->
                  </div>
                  </div>
                      @error ('permission')
                        <span class="invalid-feedback">
                          <strong>
                            {{ $message }}
                          </strong>
                        </span> 
                      @enderror
                   </div>
                   <div class="float-right mb-4">
                      <a class="btn btn-warning px-4 mx-2" href="{{ route('roles.index') }}">
                         Batal
                      </a>
                      <button type="submit" class="btn btn-info px-4">
                         Ubah
                      </button>
                   </div>
                </div>
             </form>
          </div>
       </div>
    </div>
  </div>
@endsection