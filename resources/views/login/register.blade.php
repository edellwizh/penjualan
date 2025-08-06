<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-LN+7fdVzj6u52u30Kp6M/trliBMCMKTyK833zpbD+pXdCLuTusPj697FH4R/5mcr" crossorigin="anonymous">

</head>
<body>
    <div class="container p-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <h3>Register</h3>
                <form action="{{ url('/register') }}" method="post">
                    @csrf

                    <div class="form-group">
                        <label for="name">Nama</label>
                        <input type="text" class="form-control" id="name"  name="name" required>
                    </div> 
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" class="form-control" id="email"  name="email" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" class="form-control" id="password"  name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Konfirmasi Password</label>
                        <input type="password" class="form-control" id="password_confirmation"  name="password_confirmation" required>
                    </div>
                    <p>Sudah punya akun? <a href="{{ url('/login') }}">Login</a></p>

                    {{-- Pesan sukses --}}
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        {{-- Pesan error validasi --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                    @foreach ($errors->all() as $error)
                                        {{ $error }}
                                    @endforeach
                            </div>
                        @endif

                    <button type="submit" class="btn btn-primary">Register</button>
                </form>

            </div>
        </div>
    </div>
</body>
</html>