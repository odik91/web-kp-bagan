@extends('admin.layouts.master')
@section('content')
<main>
  <div class="container-fluid">
    <h1 class="mt-4">{{ $title }}</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="#">Post List</a></li>
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
                <th>#</th>
                <th>Title</th>
                <th>Slug</th>
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
                <th>Slug</th>
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
                <td>{{ ucfirst($post['title']) }}</td>
                <td>{{ $post['slug'] }}</td>
                <td>{{ ucfirst($post->getCategory['name']) }}</td>
                <td>{{ ucfirst($post->getSubcategory['subname']) }}</td>
                <td>{{ $post['views'] }}</td>
                <td>{!! strip_tags(substr($post['content'], 0, 150)) !!}...</td>
                <td><img src="{{ asset('post/' . $post['image']) }}" alt="{{$post['image']}}" class="img-thumbnail"
                    width="150"></td>
                <td>{{ ucfirst($post->getUser['name']) }}</td>
                <td>
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