@extends('admin.layouts.master')
@section('content')
<main>
  <div class="container-fluid">
    <h1 class="mt-4">List Menu</h1>
    <ol class="breadcrumb mb-4">
      <li class="breadcrumb-item"><a href="{{ route('menu.index') }}">Menu</a></li>
      <li class="breadcrumb-item">Tambah Menu</li>
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
        <form method="POST" action={{ route('menu.store') }}>
          @csrf
          <div class="form-group">
            <label for="namaMenu">Nama menu</label>
            <input type="text" name="menu" class="form-control" id="namaMenu">
          </div>
          <div class="form-group">
            <label for="namaIcon">Icon</label>
            <input type="text" name="icon" class="form-control" id="namaIcon" aria-describedby="iconHelp">
            <small id="iconHelp" class="form-text text-muted">Icon yang digunakan dari font awesome (hanya nama icon ex:
              fa fa-tachometer-alt)</small>
          </div>
          <div class="form-group">
            <label for="routeName">Route path</label>
            <input type="text" name="route" class="form-control" id="routeName">
          </div>
          <button type="submit" class="btn btn-primary">Buat</button>
        </form>
      </div>
    </div>
    <div style="height: 100vh"></div>
    <div class="card mb-4">
      <div class="card-body">When scrolling, the navigation stays at the top of the page. This is the end of the static
        navigation demo.</div>
    </div>
  </div>
</main>
@endsection