@extends('admin.layouts.master')
@section('content')
<main>
  <div class="container-fluid">
    <h1 class="mt-4">List Kategori</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="#">Kategori</a></li>
    </ol>
    <div class="card mb-4">
      @if(Session::has('message'))
      <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ Session::get('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      @endif
      <div class="card-body">
        <a href="{{ route('category.create') }}" class="btn btn-info mb-2"><i class="fas fa-plus mr-2"></i>Tambah
          Kategori</a>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th>Deskripsi</th>
                <th>Icon</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($categories as $key => $categoriy)
              <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $categoriy['name'] }}</td>
                <td>{{ $categoriy['slug'] }}</td>
                <td>{{ $categoriy['description'] }}</td>
                @php
                $image = null;
                isset($categoriy['image']) ? $image = $categoriy['image'] : $image = 'logo.png';
                @endphp
                <td><img src="{{ asset('post-image/' . $image) }}" alt="" width="50"></td>
                <td>
                  <a href="{{ route('category.edit', $categoriy['id']) }}" class="btn btn-warning" title="edit">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="#" class="btn btn-danger" title="delete" data-toggle="modal"
                    data-target="#ModalCenter{{ $categoriy['id'] }}"><i class="fas fa-trash"></i></a>
                  <!-- Modal -->
                  <div class="modal fade" id="ModalCenter{{ $categoriy['id'] }}" tabindex="-1" role="dialog"
                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document">
                      <div class="modal-content">
                        <div class="modal-header  bg-danger">
                          <h5 class="modal-title text-white" id="exampleModalLongTitle"><strong>Perhatian!!!</strong>
                          </h5>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          Apakah anda ingin menghapus <b>{{ ucfirst($categoriy['name']) }}</b> ?
                          <br>
                          <small class="text-mute">Semua item subkategoi yang berelasi dengan kategori ini akan terhapus
                            permanen</small>
                        </div>
                        <div class="modal-footer">
                          <form action="{{ route('category.destroy', $categoriy['id']) }}" method="POST">
                            @csrf
                            @method("DELETE")
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                            <button type="submit" class="btn btn-primary">Hapus</button>
                          </form>
                        </div>
                      </div>
                    </div>
                  </div>
                </td>
              </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</main>
@endsection

@push('addon-header')
<link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet"
  crossorigin="anonymous" />
@endpush

@push('addon-script')
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
</script>
<script src="{{ asset('template/dist/js/scripts.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap4.min.js" crossorigin="anonymous"></script>
<script src="{{ asset('template/dist/assets/demo/datatables-demo.js') }}"></script>
@endpush