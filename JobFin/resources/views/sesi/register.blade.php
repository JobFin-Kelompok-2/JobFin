<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <title>Register</title>
    <style>
        .login-container{
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .gambar, .login-card-container {
            flex: 1;
        }

        .gambar{
            display: flex;
            justify-content: center;
            align-items: center;
            height: 733px;
            background-color: #FFB39A;
        }

        .gambar img{
            width: 572px;
            height: 539px;
        }

        .login-card-container{
            display: flex;
            justify-content: center;
        }

        .login-card{
            display: flex;
            flex-direction: column;
            text-align: center;
            margin: 100px;
            padding: 54px 70px;
            width: 497px;
            /* height: 600px; */
            background-color: #F5642A;
            border-radius: 20px;
            gap: 40px;
            color: white;
        }

        .login-card h1{
            font-size: 40px;
            font-weight: 700;
        }

        .form-label {
            font-weight: bold;
        }

        .form-control {
            border: 2px solid white;
            color: white;
            background-color: transparent;
        }

        .form-control:focus {
            border-color: white;
            box-shadow: none;
            background-color: transparent;
            color: white;
        }

        .action-button {
            margin-top: 30px;
        }

        .action-button .btn {
            width: 100%;
            margin-bottom: 10px;
        }

        .action-links {
            text-align: center;
            margin-top: 10px;
        }

        .action-links a {
            color: white;
            text-decoration: none;
        }
    </style>
</head>
<body>
    @include("component.navbar")

    <div class="login-container">

        <div class="login-card-container">
            <div class="login-card">
                <h1>Register</h1>
                
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('register.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">NAMA</label>
                        <input type="text" class="form-control" name="name" value="{{ old('name') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">EMAIL</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">PASSWORD</label>
                        <input type="password" class="form-control" name="password" required>
                    </div>
                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">KONFIRMASI PASSWORD</label>
                        <input type="password" class="form-control" name="password_confirmation" required>
                    </div>
                    <div class="action-button">
                        <button type="submit" class="btn btn-light">Register</button>
                    </div>

                    <div class="action-links">
                        <a href="{{ route('login') }}">Sudah punya akun? Login di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
