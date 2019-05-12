<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- Bootstrap 3.3.5 -->

    <link rel="stylesheet" href="{{ asset('bootstrap/css/bootstrap.min.css') }}">
    <!-- Theme style -->
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{ asset('css/adminLTE/skins/_all-skins.min.css') }}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{ asset('iCheck/square/blue.css') }}">

    <link rel="stylesheet" href="{{ asset('datatables/datatables.bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('select2/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/adminLTE/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('font-awesome/css/font-awesome.min.css') }}">

    <link rel="stylesheet" href="{{ asset('richtext/richtext.min.css') }}">

    <link rel="stylesheet" href="{{ asset('css/micss.css') }}">

    <style>
        .glyphicon{top: 0}
        .box-footer {padding: 10px 0}
    </style>


    <!-- Scripts -->
    <script>
        var AdminLTEOptions = {
            //Enable sidebar expand on hover effect for sidebar mini
            //This option is forced to true if both the fixed layout and sidebar mini
            //are used together
            sidebarExpandOnHover: true,
            //BoxRefresh Plugin
            enableBoxRefresh: true,
            //Bootstrap.js tooltip
            enableBSToppltip: true
        };
    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{asset('js/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="{{asset('js/adminLTE/app.min.js')}}"></script>
    <script src="{{asset('iCheck/icheck.min.js')}}"></script>
    <script src="{{asset('slimScroll/jquery.slimscroll.min.js')}}"></script>
    <script>

        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '70%' // optional
            });
        });
    </script>
    <script src="{{asset('datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{asset('fastclick/fastclick.min.js')}}"></script>
    <script src="{{asset('js/jquery.validate.min.js')}}"></script>
    <script src="{{asset('richtext/jquery.richtext.min.js')}}"></script>

</head>
<body class="hold-transition fixed skin-blue">
<div class="wrapper">

    @yield('header')

    @yield('sidebar')

    <div id="app" class="content-wrapper">
        @yield('content')
    </div>
</div>

</body>
</html>