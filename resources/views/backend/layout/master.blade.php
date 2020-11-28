<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>@yield('page_title','Dashboard') | {{ env('APP_NAME') }} </title>
        <link rel="icon" type="image/png" href="{{ asset("public/image").'/' }}favicon.ico">
        <!-- Google Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Amita:400,700|Montez|Poiret+One&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Raleway|Roboto&display=swap" rel="stylesheet">
         <!-- font family =====
        font-family: 'Amita', cursive;
        font-family: 'Montez', cursive;
        font-family: 'Poiret One', cursive; 
        font-family: 'Roboto', sans-serif;
        font-family: 'Raleway', sans-serif;
        -->
        <!-- Bootstrap -->
        <link href="{{ asset('public/backend').'/' }}css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset('public/backend').'/' }}css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset('public/backend').'/' }}css/nprogress.css" rel="stylesheet">   <!-- Select2 -->
        <link href="{{ asset('public/backend').'/' }}css/select2.min.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="{{ asset('public/backend').'/' }}css/daterangepicker.css" rel="stylesheet">
        <!-- bootstrap-datetimepicker -->
        <link href="{{ asset('public/backend').'/' }}css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- Switchery -->
        <link href="{{ asset('public/backend').'/' }}css/switchery.min.css" rel="stylesheet">
        <link href="{{ asset('public/backend').'/' }}css/green.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="{{ asset('public/backend').'/' }}datatable/jquery.dataTables.min.css" rel="stylesheet">   
        <!-- Treant -->
        <link href="{{ asset('public/backend').'/' }}css/Treant.css" rel="stylesheet">      
        <link href="{{ asset('public/backend').'/' }}css/custom-colored.css" rel="stylesheet">      
        <!-- PNotify  -->
        <link href="{{ asset('public/backend').'/' }}css/pnotify.css" rel="stylesheet">
        <link href="{{ asset('public/backend').'/' }}css/pnotify.buttons.css" rel="stylesheet">
        <link href="{{ asset('public/backend').'/' }}css/pnotify.nonblock.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{ asset('public/backend').'/' }}css/custom.min.css" rel="stylesheet">
        <link href="{{ asset('public/backend').'/' }}css/custom_fonts.css" rel="stylesheet">
        <link href="{{ asset('public/backend').'/' }}css/custom_admin.css" rel="stylesheet">
        <link href="{{ asset('public/backend').'/' }}css/custom_admin_responsive.css" rel="stylesheet">
    </head>
    <body class="nav-md">
        <div class="container body">
            <div class="main_container">
                
                <!-- left_col -->
                @includeIf('backend.layout.left_col')
                <!-- /.left_col -->
                <!-- top navigation -->
                @includeIf('backend.layout.top_navigation')
                <!-- /top navigation -->
                <!-- page content -->
                <div class="right_col" role="main">
                    <div class="">
                        <!-- Main content -->
                        @yield('main_content')
                        <!-- End: Main content -->
                    </div>
                </div>
                <!-- /.right_col -->
                <!-- footer content -->
                <footer>
                    <div class="pull-right">
                        Developed by - <a href="https://uysys.com" target="_blank">UY Systems Limited</a>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                <!-- /footer content -->
            </div>
        </div>
        <!-- jQuery -->
        <script src="{{ asset('public/backend').'/' }}js/jquery.min.js"></script>
        <!-- Bootstrap -->
        <script src="{{ asset('public/backend').'/' }}js/bootstrap.min.js"></script>
        <!-- FastClick -->
        <script src="{{ asset('public/backend').'/' }}js/fastclick.js"></script>
        <!-- NProgress -->
        <script src="{{ asset('public/backend').'/' }}js/nprogress.js"></script>
        <!-- select2 -->
        <script src="{{ asset('public/backend').'/' }}js/select2.min.js"></script>
        <!-- Chart.js -->
        <script src="{{ asset('public/backend').'/' }}js/Chart.min.js"></script>
        <script src="{{ asset('public/backend').'/' }}js/jquery.sparkline.min.js"></script>
        <!-- bootstrap-progressbar -->
        <script src="{{ asset('public/backend').'/' }}js/bootstrap-progressbar.min.js"></script>
        <!-- raphael.min.js -->
        <script src="{{ asset('public/backend').'/' }}js/raphael.min.js"></script>
        <!-- Treant js -->
        <script src="{{ asset('public/backend').'/' }}js/Treant.js"></script>
        {{-- <script src="{{ asset('public/backend').'/' }}js/custom-colored.js"></script> --}}
        <!-- Morris.min.js -->
        <script src="{{ asset('public/backend').'/' }}js/morris.min.js"></script>
        <!-- iCheck.js -->
        <script src="{{ asset('public/backend').'/' }}js/icheck.min.js"></script>
        
        <!-- DateJS -->
        <script src="{{ asset('public/backend').'/' }}js/date.js"></script>
        <!-- moment js -->
        <script src="{{ asset('public/backend').'/' }}js/moment.min.js"></script>
        <!-- bootstrap-daterangepicker -->
        <script src="{{ asset('public/backend').'/' }}js/daterangepicker.js"></script>
        <!-- bootstrap-datetimepicker -->
        <script src="{{ asset('public/backend').'/' }}js/bootstrap-datetimepicker.min.js"></script>
        <!-- Switchery -->
        <script src="{{ asset('public/backend').'/' }}js/switchery.min.js"></script>
        <!-- Datatables -->
        
        <script src="{{ asset('public/backend').'/' }}datatable/jquery.dataTables.min.js"></script>
        <script src="{{ asset('public/backend').'/' }}js/sum.js"></script>
        <!-- PNotify -->
        <script src="{{ asset('public/backend').'/' }}js/pnotify.js"></script>
        <script src="{{ asset('public/backend').'/' }}js/pnotify.buttons.js"></script>
        <script src="{{ asset('public/backend').'/' }}js/pnotify.nonblock.js"></script>       
        <!-- Custom Theme Scripts -->
        <script src="{{ asset('public/backend').'/' }}js/custom.min.js"></script>
        @includeIf('backend.layout.js.custom_js')
        @stack('scripts')
    </body>
</html>