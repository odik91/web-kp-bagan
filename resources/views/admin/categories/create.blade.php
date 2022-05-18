@extends('admin.layouts.master')
@section('content')
<main>
  <div class="container-fluid">
    <h1 class="mt-4">{{ $title }}</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('category.index') }}">Kategori</a></li>
      <li class="breadcrumb-item">Tambah Kategori</li>
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
        <form method="POST" action={{ route('category.store') }} enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="namaKategori">Nama Kategori</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="namaKategori"
              aria-describedby="iconHelp" value="{{ old('name') }}" required>
            @error('name')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="deskripsi">Deskripsi</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror"
              id="deskripsi" aria-describedby="iconHelp" value="{{ old('description') }}" required>
            @error('description')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label>Thumbnail</label>
            <div class="custom-file">
              <input type="file" class="custom-file-input @error('image') is-invalid @enderror" name="image"
                accept="image/*" id="image">
              <label class="custom-file-label" for="image">Pilih gambar thumbnail</label>
            </div>
            @error('image')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary float-right px-5">Buat</button>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection

@push('addon-script')
<script type="text/javascript">
  document.querySelector('.custom-file-input').addEventListener('change', (e) => {
    let fileName = document.getElementById('image').files[0].name
    let nextSibling = e.target.nextElementSibling
    nextSibling.innerHTML = fileName
  })
</script>
@endpush