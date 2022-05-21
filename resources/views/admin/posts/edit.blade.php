@extends('admin.layouts.master')
@section('content')
<div class="container">
  <main>
    <div class="container-fluid">
      <h1 class="mt-4">{{ $title }}</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item"><a href="{{ route('post.index') }}">Posting</a></li>
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
          <form method="POST" action={{ route('post.update', [$post['id']]) }} enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <div class="form-group">
              <label for="postTitle">Judul Posting</label>
              <input type="text" name="title" id="postTitle" class="form-control @error('title') is-invalid @enderror"
                placeholder="Masukkan Judul Posting" value="{{ $post['title'] }}" required>
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
                <option value="{{ $category['id'] }}" @if($post['category_id']===$category['id']) {{ 'selected' }}
                  @endif>{{
                  $category['name'] }}</option>
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
              <select name="subcategory" id="subcategory"
                class="form-control @error('subcategory') is-invalid @enderror">
                <option selected disabled>Pilih Subkategori</option>
                @foreach ($subcategories as $subcategory)
                <option value="{{ $subcategory['id'] }}" @if($post['sub_category_id']===$subcategory['id'])
                  {{ 'selected' }} @endif>{{ $subcategory['subname'] }}</option>
                @endforeach
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
                <input type="file" name="image" class="custom-file-input @error('image') is-invalid @enderror"
                  id="image" accept="image/*">
                <label class="custom-file-label" for="image">{{ $post['image'] }}</label>
                @error('image')
                <span class="error invalid-feedback" role="alert">
                  <strong>{{ $message }}</strong>
                </span>
                @enderror
              </div>
              <img id="imageOutput" class="img-thumbnail" width="250"
                src="{{asset('post-image/' . $post['image'])}}"><br>
            </div>
            <div class="form-group">
              <label for="summernote">Artikel Posting</label>
              <div class="input-group">
                <div style="width: 100%">
                  <textarea
                    style="width: 100%; height: 200px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"
                    class="textarea @error('article') is-invalid @enderror" name="article"
                    id="summernote">{!! $post['content'] !!}}</textarea>
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
</div>
@endsection

@push('addon-header')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
@endpush

@push('addon-script')
<script src="{{ asset('template/dist/js/scripts.js') }}"></script>
<!-- summernote css/js -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script type="text/javascript">
  let elem = "select[name='category']"

  $(elem).on('change', (e) => {
    let catId = $(elem).val()
    if (catId) {
      $.ajax({
        url: '/posts/' + catId,
        type: 'GET',
        dataType: 'json',
        success: (data) => {
          $("#subcategory").empty()
          $("#subcategory").append("<option value='' selected disabled>Pilih Subkategori</option>");
          $.each(data, (key, value) => {
            $( "#subcategory" ).append( `<option value="${key}">${value}</option>` )
          })
        }
      })
    } else {
      $("#subcategory").empty()
      $("#subcategory").append("<option value='' selected disabled>Pilih Subkategori</option>");
    }
  })

  document.querySelector('#image').addEventListener('change', (e) => {
    let output = document.getElementById('imageOutput')
    output.className = 'img-thumbnail mb-2'
    output.src = URL.createObjectURL(e.target.files[0])
    output.onload = () => {
      URL.revokeObjectURL(output.src)
    }
  })

  document.querySelector('.custom-file-input').addEventListener('change', (e) => {
    let fileName = document.getElementById('image').files[0].name
    let nextSibling = e.target.nextElementSibling
    nextSibling.innerHTML = fileName
  })

  $('#summernote').summernote({
    placeholder: 'Write your article here',
      tabsize: 4,
      height: 400,
      toolbar: [
        ['style', ['style']],
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['fontsize', ['fontsize']],
        ['color', ['color']],
        ['insert', [ 'picture', 'link', 'video', 'table']],
        ['para', ['ul', 'ol', 'paragraph']],
        ['height', ['height']],
        ['view', ['fullscreen', 'codeview', 'help']]
      ], 
      callbacks: {
        onMediaDelete: function(image) {
          console.log(image[0]);
        }
      }
  });

  $('#summernote').blur(function() {
    console.log('test');
  })
</script>
@endpush