@extends('admin.layouts.master')
@section('content')
<main>
  <div class="container-fluid">
    <h1 class="mt-4">{{ $title }}</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('subcategory.index') }}">Subkategori</a></li>
      <li class="breadcrumb-item">Tambah Subkategori</li>
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
        <form method="POST" action={{ route('post.store') }} enctype="multipart/form-data">
          @csrf
          <div class="form-group">
            <label for="postTitle">Judul Posting</label>
            <input type="text" name="title" id="postTitle" class="form-control @error('title') is-invalid @enderror">
            @error('title')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="category">Kategori</label>
            <select name="category" id="category" class="form-control @error('category') is-invalid @enderror">
              <option selected disabled>Pilih Kategori</option>
              @foreach ($categories as $category)
              <option value="{{ $category['id'] }}}">{{ $category['name'] }}</option>
              @endforeach
            </select>
            @error('category')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="subcategory">Subkategori</label>
            <select name="subcategory" id="subcategory" class="form-control @error('subcategory') is-invalid @enderror">
              <option selected disabled>Pilih Subkategori</option>
            </select>
            @error('subcategory')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="image">Gambar Utama Posting</label>
            <div class="custom-file">
              <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror" id="image"
                accept="image/*">
              <label class="custom-file-label" for="image">Pilih gambar utama postingan</label>
              @error('image')
              <span class="error invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <div class="form-group">
            <label for="article">Artikel Posting</label>
            <div class="input-group">
              <div style="width: 100%">
                <textarea
                  style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                  class="textarea @error('article') is-invalid @enderror" name="article" id="article"></textarea>
              </div>
              <div class="form-group">

                <label>Description</label>

                <textarea id="summernote" name="body"></textarea>

              </div>
              @error('article')
              <span class="error invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <button type="submit" class="btn btn-primary float-right px-5">Posting Artikel</button>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection

@push('addon-header')
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.css" />
@endpush

@push('addon-script')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.20/summernote-bs5.min.js"></script>

<script type="text/javascript">
  $(document).ready(function () {

$('#summernote').summernote({

    height: 300,

});

});

  document.querySelector('.custom-file-input').addEventListener('change', (e) => {
    let fileName = document.getElementById('image').files[0].name
    let nextSibling = e.target.nextElementSibling
    nextSibling.innerHTML = fileName
  })
</script>
@endpush