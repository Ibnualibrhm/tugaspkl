<!doctype html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login | SI-DATA</title>
  <link rel="stylesheet" href="{{ asset('assets/css/adminlte.css') }}">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
</head>
<body class="login-page bg-body-secondary">
  <div class="login-box">
    <div class="login-logo">
      <a href="#"><b>SI</b>-DATA</a>
    </div>
    <div class="card">
      <div class="card-body login-card-body">
        <p class="login-box-msg">Masuk untuk memulai sesi Anda</p>

        {{-- Error Message --}}
        @if ($errors->any())
          <div class="alert alert-danger">
            <ul class="mb-0">
              @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
              @endforeach
            </ul>
          </div>
        @endif

        <form action="{{ route('login') }}" method="POST">
          @csrf
          <div class="input-group mb-3">
            <input type="email" name="email" class="form-control" placeholder="Email" value="{{ old('email') }}" required>
            <div class="input-group-text"><span class="bi bi-envelope"></span></div>
          </div>
          <div class="input-group mb-3">
            <input type="password" name="password" class="form-control" placeholder="Password" required>
            <div class="input-group-text"><span class="bi bi-lock-fill"></span></div>
          </div>
          <div class="row">
            <div class="col-md-12">
              <div class="d-grid gap-2">
                <button type="submit" class="btn btn-primary">Masuk</button>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>
</html>