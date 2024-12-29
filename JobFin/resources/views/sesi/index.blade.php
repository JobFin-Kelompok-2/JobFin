<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <title>Login</title>
    <style>
        .login-container{
            display: flex;
            align-items: center;
            justify-content: center;
            /* border: black solid; */
        }

        .gambar, .login-card-container {
            flex: 1;
        }

        .gambar{
            /* border: blue solid; */
            display: flex;
            justify-content: center;
            align-items: center;
            height: 733px;
            background-color: #FFB39A;
        }

        .gambar img{
            width: 572px;
            height: 539px;
            /* border: red solid; */
        }

        .login-card-container{
            display: flex;
            /* flex-direction: column; */
            justify-content: center;
            /* border: purple solid; */
        }

        .login-card{
            /* border: green solid; */
            display: flex;
            flex-direction: column;
            text-align: center;
            margin: 100px;
            padding: 54px 70px;
            width: 497px;
            height: 510px;
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
        }

        .form-control:focus {
            border-color: white; 
            box-shadow: none; 
        }


        .action-button {
            display: flex;
            flex-direction: column;
            gap: 10px;
            margin-top: 60px;
        }
        .tombol{
            width: 100%;
        }
        .action-a{
            display: flex;
            justify-content: space-between;
        }
        .action-a a{
            text-decoration: none;
            color: white;
            font-size: 18px;
            font-weight: 800px;
        }
        .circle img{
            width: 100px;
        }
    </style>
</head>
<body>
    @include("component.navbar")

    <div class="login-container">
        <div class="gambar">
            <img src="../asset/people.png" alt="">
        </div>

        <div class="login-card-container">
            <div class="login-card">
    
                <h1 class="text-left">Log-in</h1>
                <form action="{{ route('login.auth') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <div class="d-flex flex-row ">
                            <label for="email" class="form-label">EMAIL</label>
                        </div>
                        <input style="background-color: transparent;" type="email" class="form-control" name="email" id="email" placeholder="Email" required>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex flex-row ">
                            <label for="password" class="form-label">PASSWORD</label>
                        </div>
                        <input style="background-color: transparent;" type="password" class="form-control" name="password" id="password" placeholder="Password" required>
                    </div>
                    <div class="action-button">
                        <button name="submit" type="submit" class="btn btn-light">Login</button>
                        <div class="action-a">
                            <a href="#">Sign up</a>
                            <a href="#">Forgot password?</a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>



    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Login Gagal!',
                text: '{{ session('error') }}',
                confirmButtonColor: '#F5642A'
            });
        @endif
    });
    </script>
</body>
</html>