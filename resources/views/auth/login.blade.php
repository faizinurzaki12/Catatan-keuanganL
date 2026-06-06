<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="{{ asset('assets/css/login.css')}}">
</head> 

<body>

    <section class="d-flex vh-100 align-items-center justify-content-center">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-11 col-sm-8 col-md-6 col-lg-5">

                    <div class="judul">
                        <h3>Catatan Keuangan</h3>
                    </div>

                    <div class="card-login">
                        @if($errors->any())
                        <div class="alert alert-danger">
                            {{ $errors->first('email')}} 
                        </div>
                        @endif
                        <form action="{{ route('login.proses')}}" method="post">
                            @csrf
                            <h3>Login</h3>
                            <input type="email" name="email" placeholder="Masukan Email" value="{{ old('email') }}" required>
                            <input type="password" name="password" placeholder="Masukan Password" required>
                            <button type="submit">Login</button>
                        </form>
                    </div>

                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>