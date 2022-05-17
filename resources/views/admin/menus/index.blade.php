@extends('admin.layouts.master')
@section('content')
<main>
  <div class="container-fluid">
    <h1 class="mt-4">List Menu</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="#">Menu</a></li>
    </ol>
    <div class="card mb-4">

      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Icon</th>
                <th>Route</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Icon</th>
                <th>Route</th>
                <th>Aksi</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($menus as $key => $menu)
              <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $menu['menu'] }}</td>
                <td>{{ $menu['icon'] }}</td>
                <td>{{ $menu['route'] }}</td>
                <td>
                  <a href="{{ route('menu.edit', $menu['id']) }}" class="btn btn-warning" title="edit">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="#" class="btn btn-danger" title="delete" data-toggle="modal"
                    data-target="#ModalCenter{{ $menu['id'] }}"><i class="fas fa-trash"></i></a>
                  <!-- Modal -->
                  <div class="modal fade" id="ModalCenter{{ $menu['id'] }}" tabindex="-1" role="dialog"
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
                          Apakah anda ingin menghapus <b>{{ ucfirst($menu['menu']) }}</b> ?
                        </div>
                        <div class="modal-footer">
                          <form action="{{ route('menu.destroy', $menu['id']) }}" method="POST">
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
    <div style="height: 100vh"></div>
    <div class="card mb-4">
      <div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static
        navigation demo.</div>
      @foreach ($menus as $menu)
      <p>{{ $menu['id'] }}</p>
      <p>{{ $menu['icon'] }}</p>
      <p>{{ $menu['route'] }}</p>
      @endforeach
    </div>
  </div>
</main>
@endsection