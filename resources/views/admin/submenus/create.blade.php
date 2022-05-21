@extends('admin.layouts.master')
@section('content')
<main>
  <div class="container-fluid">
    <h1 class="mt-4">{{ $title }}</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('submenu.index') }}">Submenu</a></li>
      <li class="breadcrumb-item">Tambah Submenu</li>
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
        <form method="POST" action={{ route('submenu.store') }}>
          @csrf
          <div class="form-group">
            <label for="basisMenu">Basis Menu</label>
            <select name="menu_id" id="basisMenu" class="form-control @error('menu_id') is-invalid @enderror" required>
              <option selected disabled>Pilih Basis Menu</option>
              @foreach (App\Models\Menu::orderBy('id', 'asc')->get() as $menu)
              <option value="{{ $menu['id'] }}">{{ $menu['menu'] }}</option>
              @endforeach
              @error('menu_id')
              <span class="error invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </select>
          </div>
          <div class="form-group">
            <label for="namaSubmenu">Nama Submenu</label>
            <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" id="namaSubmenu"
              aria-describedby="iconHelp" value="{{ old('title') }}" required>
            @error('title')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="namaIcon">Icon</label>
            <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" id="namaIcon"
              aria-describedby="iconHelp" value="{{ old('icon') }}" required>
            <small id="iconHelp" class="form-text text-muted">Icon yang digunakan dari font awesome (hanya nama icon ex:
              fa fa-tachometer-alt)</small>
            @error('icon')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="routeName">Nama Route</label>
            <input type="text" name="route" class="form-control @error('route') is-invalid @enderror" id="routeName"
              value="{{ old('route') }}" required>
            @error('route')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="active">Is active</label>
            <select name="active" id="active" class="form-control @error('active') is-invalid @enderror" required>
              <option selected disabled>Is menu active</option>
              <option value="active">Active</option>
              <option value="inactive">Inactive</option>
            </select>
            @error('active')
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