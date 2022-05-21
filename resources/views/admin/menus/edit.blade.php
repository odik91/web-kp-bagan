@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
  <h1 class="mt-4">List Menu</h1>
  <ol class="breadcrumb mb-4">
    <li class="breadcrumb-item"><a href="{{ route('menu.index') }}">Menu</a></li>
    <li class="breadcrumb-item">Edit Menu</li>
  </ol>
  <div class="card mb-4">
    <div class="card-body">
      <form method="POST" action={{ route('menu.update', [$menu['id']]) }}>
        @csrf
        @method('PATCH')
        <div class="form-group">
          <label for="namaMenu">Nama menu</label>
          <input type="text" name="menu" class="form-control @error('menu') is-invalid @enderror" id="namaMenu"
            value="{{ $menu['menu'] }}">
          @error('menu')
          <span class="error invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <div class="form-group">
          <label for="namaIcon">Icon</label>
          <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" id="namaIcon"
            value="{{ $menu['icon'] }}" aria-describedby="iconHelp">
          @error('icon')
          <span class="error invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
          <small id="iconHelp" class="form-text text-muted">Icon yang digunakan dari font awesome (hanya nama icon ex:
            fa fa-tachometer-alt)</small>
        </div>
        <div class="form-group">
          <label for="routeName">Route path</label>
          <input type="text" name="route" class="form-control @error('icon') is-invalid @enderror" id="routeName"
            value="{{ ($menu['route'] == 'none') ? "" : $menu['route'] }}">
          @error('icon')
          <span class="error invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
          </span>
          @enderror
        </div>
        <button type="submit" class="btn btn-primary">Ubah</button>
      </form>
    </div>
  </div>
</div>
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