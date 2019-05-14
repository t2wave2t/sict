<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'UTM Times';
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
            .m-b-md1 {
                margin-bottom:-50px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @if (Auth::check())
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ url('/login') }}">Đăng nhập</a>
                        <!-- <a href="{{ url('/register') }}">Register</a> -->
                    @endif
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md1">
                    <img src="{{ url('public/img/logo.png') }}" style="width: 20%; height: 20%" >
                </div>

                <div class="title m-b-md">
                    Khoa Công nghệ thông tin <br />và truyền thông
                </div>

                <div class="links">
                    <a href="https://laravel.com/docs">Trang chủ</a>
                    <a href="https://laracasts.com">Đào tạo</a>
                    <a href="https://laravel-news.com">Tin tức</a>
                    <a href="https://forge.laravel.com">Nghiên cứu Khoa học</a>
                    <a href="https://github.com/laravel/laravel">Về chúng tôi</a>
                </div>
            </div>
        </div>
    </body>
</html>
