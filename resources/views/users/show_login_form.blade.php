<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('page_title','Login') | {{ env('APP_NAME') }} </title>
    <link rel="icon" type="image/png" href="{{ asset("public/image").'/' }}favicon.ico">
    <!-- Bootstrap -->
    <link href="{{ asset('public/backend').'/' }}css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="{{ asset('public/backend').'/' }}css/font-awesome.min.css" rel="stylesheet">
    <!-- NProgress -->
    <link href="{{ asset('public/backend').'/' }}css/nprogress.css" rel="stylesheet">
    <!-- Custom Theme Style -->
    <link href="{{ asset('public/backend').'/' }}css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
    <div>
        <div class="login_wrapper" style="margin-top: 45px;">

            <div class="row" >
                <div class="col-xs-12">
                    <img src="{{ asset('public/image').'/logo.svg' }}" alt="Logo" class="center-block" style="width: 100%; display: inline-block;">                    
                </div>
            </div>
            <div class="animate form login_form">
                <section class="login_content" style="margin-top: 100px; ">
                    <form action="{{ $users_login }}" method="post">
                        @csrf
                        <h1>My Office Login</h1>
                        @if(count($errors->all()) || session('alert'))
                        <div class="alert alert-danger alert-dismissible fade in" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
                            </button>
                            <strong>Invalid Email or Password</strong> <hr>
                            <ul class="text-left">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            {{ session('alert') }}
                            
                        </div>
                        @endif
                        <div>
                            <input type="text" class="form-control" placeholder="Email" name="email" id="email" value="{{ old('email') }}" />
                        </div>
                        <div>
                            <input type="password" class="form-control" placeholder="Password" name="password" id="password" value="{{ old('password') }}" /> 
                        </div>
                        <div>
                            <input type="submit" class="btn btn-info " value="Login">
                            <a class="reset_pass" href="">Lost your password?</a>
                        </div>

                        <div class="clearfix"></div>
                        <!-- <p class="help-block">Test email: admin@uysys.com, password: 12345</p> -->

                        <div class="separator">
                            

                            <div class="clearfix"></div>
                            <br />

                            <div>
                                <h1>UY Systems Limited</h1>
                                <p>&copy;{{ date('Y') }} All Rights Reserved.</p>
                            </div>
                        </div>
                    </form>
                </section>
            </div>

        </div>
    </div>
    <!-- jQuery -->
    <script src="{{ asset('public/backend').'/' }}js/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="{{ asset('public/backend').'/' }}js/bootstrap.min.js"></script>
</body>

</html>