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
            <label for="routeName">Route name</label>
            <input type="text" name="route" class="form-control" id="routeName">
          </div>
          <button type="submit" class="btn btn-primary">Buat</button>
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