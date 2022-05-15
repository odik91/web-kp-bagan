<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <meta name="description" content="" />
  <meta name="author" content="" />
  <title>Page Title - SB Admin</title>
  <link href="{{asset('template/dist/css/styles.css')}}" rel="stylesheet"" />
  <script src=" https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous">
  </script>
</head>

<body class="bg-primary">
  <div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
      <main>
        <div class="container">
          <div class="row justify-content-center">
            <div class="col-lg-7">
              <div class="card shadow-lg border-0 rounded-lg mt-5">
                <div class="card-header">
                  <h3 class="text-center font-weight-light my-4">Buat Akun</h3>
                </div>
                <div class="card-body">
                  <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                      <label class="small mb-1" for="inputNama">Nama</label>
                      <input class="form-control py-4 @error('name') is-invalid @enderror" id="inputNama" name="name"
                        type="text" aria-describedby="nameHelp" placeholder="Masukkan nama" required />
                      @error('name')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-group">
                      <label class="small mb-1" for="inputEmailAddress">Email</label>
                      <input class="form-control py-4 @error('email') is-invalid @enderror" id="inputEmailAddress"
                        name="email" type="email" aria-describedby="emailHelp" placeholder="Masukkan alamat email"
                        required />
                      @error('email')
                      <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                      </span>
                      @enderror
                    </div>
                    <div class="form-row">
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="small mb-1" for="inputPassword">Password</label>
                          <input class="form-control py-4 @error('password') is-invalid @enderror" id="inputPassword"
                            name="password" type="password" placeholder="Masukkan password" required />
                          @error('password')
                          <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                          </span>
                          @enderror
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                          <label class="small mb-1" for="inputConfirmPassword">Konfirmasi Password</label>
                          <input class="form-control py-4" id="inputConfirmPassword" name="password_confirmation"
                            type="password" placeholder="Konfirmasi password" required />
                        </div>
                      </div>
                    </div>
                    <div class="form-group mt-4 mb-0">
                      <button class="btn btn-primary btn-block" type="submit">Daftar</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center">
                  <div class="small"><a href="login.html">Punya akun? Login</a></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </main>
    </div>
    <div id="layoutAuthentication_footer">
      <footer class="py-4 bg-light mt-auto">
        <div class="container-fluid">
          <div class="d-flex align-items-center justify-content-between small">
            <div class="text-muted">Copyright &copy; KKN Sistem Informasi 2022 Univ Batam @php {{ echo date("Y"); }}
              @endphp
            </div>
            <div>
              <a href="#">Privacy Policy</a>
              &middot;
              <a href="#">Terms &amp; Conditions</a>
            </div>
          </div>
        </div>
      </footer>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
  </script>
  <script src="{{asset('js/scripts.js')}}"></script>
</body>

</html>