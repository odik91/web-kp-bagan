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
        <form method="POST" action={{ route('submenu.update', [$submenu['id']]) }}>
          @csrf
          @method(' PATCH') <div class="form-group">
            <label for="basisMenu">Basis Menu</label>
            <select name="menu_id" id="basisMenu" class="form-control @error('menu_id') is-invalid @enderror" required>
              @foreach (App\Models\Menu::orderBy('id', 'asc')->get() as $menu)
              <option value="{{ $menu['id'] }}" {{ ($submenu['menu_id']==$menu['id']) ? "selected" : "" }}>{{
                $menu['menu'] }}</option>
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
              aria-describedby="iconHelp" value="{{ $submenu['title'] }}" required>
            @error('title')
            <span class="error invalid-feedback" role="alert">
              <strong>{{ $message }}</strong>
            </span>
            @enderror
          </div>
          <div class="form-group">
            <label for="namaIcon">Icon</label>
            <input type="text" name="icon" class="form-control @error('icon') is-invalid @enderror" id="namaIcon"
              aria-describedby="iconHelp" value="{{ $submenu['icon'] }}" required>
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
              value="{{ $submenu['route'] }}" required>
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
              <option value="active" {{ (strtolower($submenu['active'])=='active' ) ? "selected" : "" }}>Active</option>
              <option value="inactive" {{ (strtolower($submenu['active'])=='inactive' ) ? "selected" : "" }}>Inactive
              </option>
            </select>
            @error('active')
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