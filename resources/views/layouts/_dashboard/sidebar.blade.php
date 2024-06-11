<aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-4 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="{{ route ('homepage.home') }}" target="_blank">
        <img src="{{asset('template/img/dishub.png')}}" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">&nbsp;&nbsp;&nbsp;ANDALALIN</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link {{set_active('dashboard.index')}}" href="{{route('dashboard.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Dashboard</span>
          </a>
        </li>
        @can('manage_data_permohonan', 'manage_data_pemohon')
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Permohonan</h6>
        </li>
        @endcan
        <li class="nav-item">
          @can('manage_data_permohonan')
          <a class="nav-link {{set_active(['data-permohonan.index', 'data-permohonan.create', 'data-permohonan.edit'])}}" href="{{route('data-permohonan.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Data Permohonan</span>
          </a>
          @endcan
        </li>
        <li class="nav-item">
          @can('manage_data_pemohon')
          <a class="nav-link {{set_active(['data-pemohon.index', 'data-pemohon.show'])}}" href="{{route('data-pemohon.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-app text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Data Pemohon</span>
          </a>
          @endcan
        </li>
        @can('manage_pengajuan_permohonan', 'manage_edit_profil')
        <li class="nav-item mt-3">
            <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Pengajuan Permohonan</h6>
        </li>
        @endcan
        <li class="nav-item">
          @can('manage_pengajuan_permohonan')
          <a class="nav-link {{set_active(['pengajuan-permohonan.index', 'pengajuan-permohonan.create', 'pengajuan-permohonan.edit', 'pengajuan-permohonan.show'])}}" href="{{route('pengajuan-permohonan.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-archive-2 text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Pengajuan Permohonan </span>
          </a>
          @endcan
        </li>
        <li class="nav-item">
          @can('manage_edit_profil')
          @if ($user = Auth::user()->id)
          <a class="nav-link {{set_active('users.edit_profil')}}" href="{{route('users.edit_profil', ['user' => $user])}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="ni ni-single-02 text-info text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Edit Profil</span>
          </a>
          @endif
          @endcan
        </li>
        @can('manage_users', 'manage_roles')
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">User Permission</h6>
        </li>
        @endcan
        <li class="nav-item">
          @can('manage_users')
          <a class="nav-link {{set_active(['users.index', 'users.create', 'users.edit', 'users.show'])}}" href="{{route('users.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-fw fa-users text-warning text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Users</span>
          </a>
          @endcan
        </li>
        <li class="nav-item">
          @can('manage_roles')
          <a class="nav-link {{set_active(['roles.index', 'roles.create', 'roles.edit', 'roles.show'])}}" href="{{route('roles.index')}}">
            <div class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
              <i class="fas fa-fw fa-user-shield text-success text-sm opacity-10"></i>
            </div>
            <span class="nav-link-text ms-1">Roles</span>
          </a>
          @endcan
        </li>
      </ul>
    </div>
    <div class="sidenav-footer mx-3 ">
      <div class="card card-plain shadow-none" id="sidenavCard">
        <div class="card-body text-center p-5 w-100 pt-0">
        </div>
      </div>
      <a href="{{ route('users.change_password') }}" class="btn btn-primary btn-sm w-100 mb-3 {{set_active('users.change_password')}}">Change Password</a>
      <a class="btn btn-dark btn-sm w-100 mb-3" href="{{ route('logout') }}"onclick="event.preventDefault();document.getElementById('logout-form').submit();">
        Sign Out
      </a>
      <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
      </form>
    </div>
  </aside>