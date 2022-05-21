@extends('admin.layouts.master')
@section('content')
<main>
  <div class="container-fluid">
    <h1 class="mt-4">{{ $title }}</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Kategori</a></li>
      <li class="breadcrumb-item">Ubah Kategori</li>
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
        <form method="POST" action="{{ route('category.update', $category['id']) }}" enctype="multipart/form-data">
          @csrf
          @method('PATCH')
          <div class="form-group">
            <label for="namaKategori">Nama Kategori</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="namaKategori"
              aria-describedby="iconHelp" value="{{ $category['name'] }}" required>
            @error('name')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
              id="deskripsi" aria-describedby="iconHelp" value="{{ $category['description'] }}" required>
            @error('description')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary float-right px-5">Ubah</button>
        </form>
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
@endpush