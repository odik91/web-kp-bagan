@extends('admin.layouts.master')
@section('content')
<main>
  <div class="container-fluid">
    <h1 class="mt-4">List Kategori</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Kategori</a></li>
      <li class="breadcrumb-item">{{ $title }}</li>
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
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th>Deskripsi</th>
                <th>Thumbnail</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Nama Kategori</th>
                <th>Slug</th>
                <th>Deskripsi</th>
                <th>Thumbnail</th>
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
                <td><img class="img-fluid img-thumbnail" src="{{ asset('img/' . $categoriy['image']) }}"
                    alt="{{ $categoriy['image'] }}"></td>
                <td>
                  <a href="{{ route('category.restore', $categoriy['id']) }}" class="btn btn-warning" title="restore">
                    <i class="fas fa-trash-restore"></i>
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
                          <form action="{{ route('category.delete', $categoriy['id']) }}" method="POST">
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