<!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl " id="navbarBlur" data-scroll="false">
      <div class="container-fluid py-1 px-3">        
        @if(set_active('dashboard.index'))
           @include('breadcrumbs.dashboard')
        @elseif(set_active('data-permohonan.index'))
           @include('breadcrumbs.permohonan.data-permohonan')
        @elseif(set_active('data-permohonan.create'))
           @include('breadcrumbs.permohonan.create-permohonan')
        @elseif(set_active('data-permohonan.edit'))
           @include('breadcrumbs.permohonan.edit-permohonan')
        @elseif(set_active('roles.index'))
           @include('breadcrumbs.roles.roles')
        @elseif(set_active('roles.create'))
           @include('breadcrumbs.roles.create-roles')
        @elseif(set_active('roles.edit'))
           @include('breadcrumbs.roles.edit-roles')
        @elseif(set_active('roles.show'))
           @include('breadcrumbs.roles.detail-roles')
        @elseif(set_active('users.index'))
           @include('breadcrumbs.user.user')
        @elseif(set_active('users.create'))
           @include('breadcrumbs.user.create-user')
        @elseif(set_active('users.edit'))
           @include('breadcrumbs.user.edit-user')
        @elseif(set_active('users.show'))
           @include('breadcrumbs.user.detail-user')
        @elseif(set_active('users.change_password'))
           @include('breadcrumbs.user.change-password')
        @elseif(set_active('users.edit_profil'))
           @include('breadcrumbs.user.edit-profil')
        @elseif(set_active('pengajuan-permohonan.index'))
           @include('breadcrumbs.pengajuan-permohonan.pengajuan-permohonan')
        @elseif(set_active('pengajuan-permohonan.create'))
           @include('breadcrumbs.pengajuan-permohonan.create-pengajuan-permohonan')
        @elseif(set_active('pengajuan-permohonan.edit'))
           @include('breadcrumbs.pengajuan-permohonan.edit-pengajuan-permohonan')
        @elseif(set_active('pengajuan-permohonan.show'))
           @include('breadcrumbs.pengajuan-permohonan.detail-pengajuan-permohonan')
        @elseif(set_active('data-pemohon.index'))
           @include('breadcrumbs.pemohon.data-pemohon')
        @elseif(set_active('data-pemohon.show'))
           @include('breadcrumbs.pemohon.detail-pemohon')
        @endif

        
        <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
          <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            
          </div>
          <ul class="navbar-nav  justify-content-end">
            <li class="nav-item d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                <i class="fa fa-user me-sm-1"></i>
                <span class="d-sm-inline d-none">{{Auth::user()->nama_user}}</span>
              </a>
            </li>
            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
              <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                <div class="sidenav-toggler-inner">
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                  <i class="sidenav-toggler-line bg-white"></i>
                </div>
              </a>
            </li>
          </ul>
        </div>
      </div>
    </nav>
    <!-- End Navbar -->