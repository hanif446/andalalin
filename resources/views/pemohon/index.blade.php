@extends('layouts.dashboard')

@section('title')
  Data Pemohon
@endsection

@section('content')
  <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-4">
                  <form action="{{route('data-pemohon.index')}}" method="GET">
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
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Judul Permohonan</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Nama Pemohon</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Status</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Detail</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Opsi</th>
                    </tr>
                  </thead>
                  <tbody>
                    @php $no = 1; @endphp
                    @forelse ($pemohons as $pemohon)
                    <tr>
                      <td class="align-middle text-center">
                         <p class="text-xs font-weight-bold mb-0">{{ $no++ }}</p>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $pemohon->judul }}</p>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0">{{ $pemohon->nama_pemohon }}</p>
                      </td>
                      <td class="align-middle text-center">
                        <p class="text-xs font-weight-bold mb-0">
                          @if ($pemohon->status == '0')
                            <span class="badge badge-sm bg-gradient-warning">Belum Disetujui</span>
                          @elseif ($pemohon->status == '1')
                            <span class="badge badge-sm bg-gradient-success">Disetujui</span>
                          @else
                            <span class="badge badge-sm bg-gradient-danger">Tidak Disetujui</span>
                          @endif
                        </p>
                      </td>
                      <td class="align-middle text-center">
                        @can('data_pemohon_detail')
                        <a href="{{ route('data-pemohon.show', ['data_pemohon'=>$pemohon]) }}" title="Detail" class="badge badge-sm bg-gradient-info">
                            <i class="fas fa-eye"></i>
                        </a>
                        @endcan
                      </td>
                      <td class="align-middle text-center">
                        <form method="post" class="d-inline" action="{{ route('data-pemohon.disetujui', ['data_pemohon'=>$pemohon]) }}">
                        @csrf
                        @method('PUT')
                          <button type="submit" class="badge badge-sm bg-gradient-success" style="border:0;">
                            <i class="fas fa-check"></i>
                          </button>
                        </form>
                        <form method="post" class="d-inline" action="{{ route('data-pemohon.tidak_disetujui', ['data_pemohon'=>$pemohon]) }}">
                        @csrf
                        @method('PUT')
                          <button type="submit" class="badge badge-sm bg-gradient-danger" style="border:0;">
                            <i class="fa fa-remove"></i>
                          </button>
                        </form>
                      </td>
                    </tr>
                    @empty
                    <p>
                      <strong>
                        @if (request()->get('keyword'))
                         {{request()->get('keyword')}} Not Found in Pemohon
                        @else
                          No Pemohon Data Yet
                        @endif
                      </strong>
                    </p>
                    @endforelse
                  </tbody>
                </table>
              </div>
            </div>
            @if ($pemohons->hasPages())
             <div class="card-footer">
                {{$pemohons->links('vendor.pagination.bootstrap-5')}}
             </div>
           @endif
          </div>
        </div>
      </div>
@endsection