<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <!-- Meta, title, CSS, favicons, etc. -->
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>@yield('page_title','Dashboard') | {{ env('APP_NAME') }} </title>
        <link rel="icon" type="image/png" href="{{ asset("public/images").'/' }}favicon.png">
        <!-- Bootstrap -->
        <link href="{{ asset('public/backend').'/' }}css/bootstrap.min.css" rel="stylesheet">
        <!-- Font Awesome -->
        <link href="{{ asset('public/backend').'/' }}css/font-awesome.min.css" rel="stylesheet">
        <!-- NProgress -->
        <link href="{{ asset('public/backend').'/' }}css/nprogress.css" rel="stylesheet">
        <!-- bootstrap-daterangepicker -->
        <link href="{{ asset('public/backend').'/' }}css/daterangepicker.css" rel="stylesheet">
        <!-- bootstrap-datetimepicker -->
        <link href="{{ asset('public/backend').'/' }}css/bootstrap-datetimepicker.css" rel="stylesheet">
        <!-- Switchery -->
        <link href="{{ asset('public/backend').'/' }}css/switchery.min.css" rel="stylesheet">
        <link href="{{ asset('public/backend').'/' }}css/green.css" rel="stylesheet">
        <!-- Datatables -->
        <link href="{{ asset('public/backend').'/' }}css/dataTables.bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('public/backend').'/' }}css/buttons.bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('public/backend').'/' }}css/fixedHeader.bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('public/backend').'/' }}css/responsive.bootstrap.min.css" rel="stylesheet">
        <link href="{{ asset('public/backend').'/' }}css/scroller.bootstrap.min.css" rel="stylesheet">
        <!-- Custom Theme Style -->
        <link href="{{ asset('public/backend').'/' }}css/custom.min.css" rel="stylesheet">
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
                        Developed by <a href="https://likaspro.com" target="_blank">Likas Procedure</a>
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
        <!-- Chart.js -->
        <script src="{{ asset('public/backend').'/' }}js/Chart.min.js"></script>
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
        <script src="{{ asset('public/backend').'/' }}js/jquery.dataTables.min.js"></script>
        <script src="{{ asset('public/backend').'/' }}js/dataTables.bootstrap.min.js"></script>
{{--         <script src="{{ asset('public/backend').'/' }}js/dataTables.buttons.min.js"></script>
        <script src="{{ asset('public/backend').'/' }}js/buttons.bootstrap.min.js"></script>
        <script src="{{ asset('public/backend').'/' }}js/buttons.flash.min.js"></script>
        <script src="{{ asset('public/backend').'/' }}js/buttons.html5.min.js"></script>
        <script src="{{ asset('public/backend').'/' }}js/buttons.print.min.js"></script> --}}
        {{-- <script src="{{ asset('public/backend').'/' }}js/dataTables.fixedHeader.min.js"></script> --}}
        <script src="{{ asset('public/backend').'/' }}js/dataTables.keyTable.min.js"></script>
{{--         <script src="{{ asset('public/backend').'/' }}js/dataTables.responsive.min.js"></script>
        <script src="{{ asset('public/backend').'/' }}js/responsive.bootstrap.js"></script> --}}
        {{-- <script src="{{ asset('public/backend').'/' }}js/dataTables.scroller.min.js"></script> --}}
        <script src="{{ asset('public/backend').'/' }}js/jszip.min.js"></script>
        <script src="{{ asset('public/backend').'/' }}js/pdfmake.min.js"></script>
        <script src="{{ asset('public/backend').'/' }}js/vfs_fonts.js"></script>
       
        <!-- Custom Theme Scripts -->
        <script src="{{ asset('public/backend').'/' }}js/custom.min.js"></script>
        @stack('scripts')
    </body>
</html>