@extends('admin.layouts.master')
@section('content')
<main>
  <div class="container-fluid">
    <h1 class="mt-4">{{ $title }}</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('subcategory.index') }}">Subkategori</a></li>
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
        <form method="POST" action={{ route('subcategory.update', [$subcategory['id']]) }}>
          @csrf
          @method('PATCH')
          <div class="form-group">
            <label for="basisKategori">Basis Subkategori</label>
            <select name="category_id" id="basisKategori"
              class="form-control @error('category_id') is-invalid @enderror" required>
              <option selected disabled>Pilih Basis Subkategori</option>
              @foreach ($categories as $category)
              <option value="{{ $category['id'] }}" @if ($subcategory['category_id']==$category['id']) {{ 'selected' }}
                @endif>{{ $category['name'] }}</option>
              @endforeach
              @error('category_id')
              <span class="error invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </select>
          </div>
          <div class="form-group">
            <label for="namaSubkategori">Nama Subkategori</label>
            <input type="text" name="subname" class="form-control @error('subname') is-invalid @enderror"
              id="namaSubkategori" aria-describedby="iconHelp" value="{{ $subcategory['subname'] }}" required>
            @error('subname')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <button type="submit" class="btn btn-primary float-right px-5">Ubah</button>
          <a href="{{ route('subcategory.index') }}" class="btn btn-secondary float-right px-5 mr-2">Batal</a>
        </form>
      </div>
    </div>
  </div>
</main>
@endsection