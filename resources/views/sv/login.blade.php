<!DOCTYPE html>
<html lang="en">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Khoa Công nghệ thông tin và truyền thông</title>

    <!-- Bootstrap -->
    <link href="{{ url('vendor/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ url('vendor/font-awesome/css/font-awesome.min.css') }}" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ url('vendor/nprogress/nprogress.css') }}" rel="stylesheet">
    <!-- Animate.css -->
    <link href="{{ url('vendor/animate.css/animate.min.css') }}" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="{{ url('public/gv/build/css/custom.min.css') }}" rel="stylesheet">
</head>

<body class="login">
<div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
        <div class="animate form login_form">
            <section class="login_content">
                <form action="{{ route('sv.getLoginsv') }}" method="POST">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <h1>Sinh viên</h1>
                    <div>
                        <input type="text" class="form-control" placeholder="Mã sinh viên" name="username" required="" />
                    </div>
                    <!-- <div>
                        <input type="password" class="form-control" placeholder="Password" name="password" required="" value="123456" />
                    </div> -->
                    <div>
                        <button class="btn btn-default submit">Đăng nhập</button>

                    </div>

                    <div class="clearfix"></div>

                    <div class="separator">
                        <p class="change_link">Đến Trang chủ
                            <a href="sict.udn.vn" class="to_register"> Khoa Công nghệ thông tin và Truyền thông </a>
                        </p>

                        <div class="clearfix"></div>
                        <br />

                        <div>
                            <h1><i class="fa fa-university"></i> SICT!</h1>
                            <p>©2017 Bản quyền thuộc về Khoa Công nghệ thông tin và Truyền thông - Đại học Đà Nẵng</p>
                        </div>
                    </div>
                </form>
            </section>
        </div>


    </div>
</div>
</body>
</html>
