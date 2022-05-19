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
<script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
  integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>

{{--
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
  integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"> --}}
{{-- <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
  integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
--}}

<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
@endpush

@push('addon-script')
<script type="text/javascript">
  document.querySelector('.custom-file-input').addEventListener('change', (e) => {
    let fileName = document.getElementById('image').files[0].name
    let nextSibling = e.target.nextElementSibling
    nextSibling.innerHTML = fileName
  })
</script>
@endpush