@extends('admin.layouts.master')
@section('content')
<main>
  <div class="container-fluid">
    <h1 class="mt-4">{{ $title }}</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route ('post.index') }}">Posting</a></li>
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
        <div class="container-fluid bg-dark mb-2 rounded">
          <div class="row">
            <div class="col-sm">
            </div>
            <div class="col-sm">
            </div>
            <div class="col-sm text-right">
              <a class="btn btn-outline-info btn-light my-2" href="{{ route('post.create') }}"><i
                  class="fas fa-plus"></i> Buat
                Posting
                Baru</a>
            </div>
          </div>
        </div>
        <div class="table-responsive">
          <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Viewer</th>
                <th>Content</th>
                <th>Image</th>
                <th>Author</th>
                <th>Action</th>
              </tr>
            </thead>
            <tfoot>
              <tr>
                <th>#</th>
                <th>Title</th>
                <th>Category</th>
                <th>Subcategory</th>
                <th>Viewer</th>
                <th>Content</th>
                <th>Image</th>
                <th>Author</th>
                <th>Action</th>
              </tr>
            </tfoot>
            <tbody>
              @foreach ($posts as $key => $post)
              <tr>
                <td>{{ ++$key }}</td>
                <td>{{ ucwords($post['title']) }}</td>
                <td>
                  @php
                  $category = App\Models\Category::where('id', $post['category_id']);
                  @endphp
                  @if (count($category->get()) > 0)
                  {{ ucfirst($category->first()->name) }}
                  @else
                  {{ "Kategori belum diatur" }}
                  @endif
                </td>
                <td>
                  @php
                  $subcategory = App\Models\SubCategory::where('id', $post['sub_category_id'])->get();
                  @endphp
                  @if (count($subcategory) > 0)
                  {{ ucfirst(App\Models\SubCategory::where('id', $post['sub_category_id'])->first()->subname) }}
                  @else
                  {{ "Subkategori belum diatur" }}
                  @endif
                </td>
                <td>
                  @if ($post['views'] > 0)
                  {{$post['views']}}
                  @else
                  {{ 'Belum ada pengunjung' }}
                  @endif
                </td>
                <td>{!! strip_tags(substr($post['content'], 0, 150)) !!}...</td>
                <td>
                  @if (substr($post['image'], 0, 4) === 'http')
                  <img src="{{ $post['image'] }}" alt="{{$post['image']}}" class="img-thumbnail" width="150">
                  @else
                  <img src="{{ asset('post-image/' . $post['image']) }}" alt="{{$post['image']}}" class="img-thumbnail"
                    width="150">
                  @endif
                </td>
                <td>{{ ucfirst($post->getUser['name']) }}</td>
                <td>
                  <a href="{{ route('post.show', $post['id']) }}" class="btn btn-info mb-1" title="view"><i
                      class="far fa-eye"></i></a>
                  <a href="{{ route('post.edit', $post['id']) }}" class="btn btn-warning" title="edit">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="#" class="btn btn-danger" title="delete" data-toggle="modal"
                    data-target="#ModalCenter{{ $post['id'] }}"><i class="fas fa-trash"></i></a>
                  <!-- Modal -->
                  <div class="modal fade" id="ModalCenter{{ $post['id'] }}" tabindex="-1" role="dialog"
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
                          Apakah anda ingin menghapus <b>{{ ucfirst($post['title']) }}</b> ?
                        </div>
                        <div class="modal-footer">
                          <form action="{{ route('post.destroy', $post['id']) }}" method="POST">
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