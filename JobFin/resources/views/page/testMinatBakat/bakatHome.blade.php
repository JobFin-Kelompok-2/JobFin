<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teknis Home</title>
    <style>

        .container{
            display: flex;
            /* flex-direction: column; */
            align-items: center;
            margin: 0;
            padding: 0;
            gap: 20px;
            /* border: purple solid; */
            justify-content: space-between;
        }

        .left-content, .right-content{
            width: 300px;
            /* border: red solid; */
        }
        
        .left-content img, .right-content img{
            width: 300px;
        }

        .middle{
            display: flex;
            flex-direction: column;
            gap: 20px;
            margin-top: -120px;
        }

        .middle button{
            width: 200px;
            align-self: center;
        }

        .container .text{
            display: flex;
            flex-direction: column;
            text-align: center;
        }

        .container p{
            font-size: 34px;
            font-weight: 700;
        }
        .right-content{
            width: 500px;
        }

        .right-content img{
            width: 470px;
        }
    </style>
</head>
<body>
    @include("component.navbarLogin")
    <div class="outside-container">
        <div class="container mt-5">
    
            <div></div>

            <div class="middle">
                <div class="text">
                    <p>Selamat Datang di</p>
                    <p>Tes minat bakat</p>
                </div>
                <button class="btn btn-primary btn-lg" onclick="window.location.href='{{ route('bakat.soal') }}'">Mulai Test!</button>
            </div>
    
            <div class="right-content">
                <img src="/asset/bakat.png" alt="">
            </div>
        </div>
    </div>
</body>
</html>