@extends('layouts.master')
@section('content')
<form class="form-login" method="POST" action="{{ route('login') }}">
  @csrf
  <h2 class="form-login-heading">Masuk Sekarang</h2>
  <div class="login-wrap">
    <input type="text" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}"
      placeholder="Email" autofocus>
    @error('email')
    <span class="invalid-feedback" role="alert">
      <strong>{{ $message }}</strong>
    </span>
    @enderror
    <br>
    <input type="password" class="form-control" placeholder="Password">
    <label class="checkbox">
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Ingat
      saya') }}
      <span class="pull-right">
        <a data-toggle="modal" href="#myModal"> Lupa password?</a>
      </span>
    </label>
    <button class="btn btn-theme btn-block" type="submit"><i class="fa fa-lock"></i> MASUK</button>
    <hr>
    <div class="registration">
      Belum punya akun?<br />
      <a class="" href="{{ route('register') }}">
        Buat akun
      </a>
    </div>
  </div>
  <!-- Modal -->
  <div aria-hidden="true" aria-labelledby="myModalLabel" role="dialog" tabindex="-1" id="myModal" class="modal fade">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
          <h4 class="modal-title">Forgot Password ?</h4>
        </div>
        <div class="modal-body">
          <p>Enter your e-mail address below to reset your password.</p>
          <input type="text" name="email" placeholder="Email" autocomplete="off"
            class="form-control placeholder-no-fix">
        </div>
        <div class="modal-footer">
          <button data-dismiss="modal" class="btn btn-default" type="button">Cancel</button>
          <button class="btn btn-theme" type="button">Submit</button>
        </div>
      </div>
    </div>
  </div>
  <!-- modal -->
</form>
@endsection