<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="msapplication-TileColor" content="#0061da">
    <meta name="theme-color" content="#1643a3">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="HandheldFriendly" content="True">
    <meta name="MobileOptimized" content="320">

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="_csrf" content="{{csrf_token()}}"/>
    <title>{{ config('app.name', 'MailSystem') }}</title>

    <!-- Font Family-->
    <link rel="stylesheet" href="{{ asset('fonts/fonts/font-awesome.min.css') }}">
    <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700" rel="stylesheet">

    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <link href="{{ asset('plugins/morris/morris.css') }}" rel="stylesheet" />
    <!-- custom stylesheets -->
    {{--    <link href="{{ asset('css/app.css') }}" rel="stylesheet">--}}
    <!-- Custom scroll bar css-->
    <link href="{{asset('plugins/scroll-bar/jquery.mCustomScrollbar.css')}}" rel="stylesheet" />

    <!-- Sidemenu Css -->
    <link href="{{asset('plugins/toggle-sidebar/css/sidemenu.css')}}" rel="stylesheet" />

    <!-- Tabs Style -->
    <link href="{{asset('plugins/tabs/style.css')}}" rel="stylesheet" />

    <!---Font icons-->
    <link href="{{asset('plugins/iconfonts/plugin.css')}}" rel="stylesheet" />

    <!-- select2 Plugin -->
    <link href="{{asset('plugins/select2/select2.min.css')}}" rel="stylesheet" />
    <!-- /global stylesheets -->

    @yield('page-css')

    <!-- Core JS files -->

{{--    <script src="{{ asset('js/vendors/bootstrap.bundle.min.js') }}"></script>--}}
{{--    <script src="{{ asset('js/vendors/jquery-3.2.1.min.js') }}"></script>--}}
{{--    <script src="{{ asset('js/vendors/jquery.sparkline.min.js') }}"></script>--}}
{{--    <script src="{{ asset('js/vendors/selectize.min.js') }}"></script>--}}
{{--    <script src="{{ asset('js/vendors/jquery.tablesorter.min.js') }}"></script>--}}
{{--    <!-- /core JS files -->--}}

{{--    <!-- Fullside-menu Js-->--}}
{{--    <script src="{{ asset('plugins/toggle-sidebar/js/sidemenu.js') }}"></script>--}}

{{--    <script src="{{ asset('plugins/input-mask/jquery.mask.min.js') }}"></script>--}}

{{--    <!-- Custom scroll bar Js-->--}}
{{--    <script src="{{ asset('plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') }}"></script>--}}

{{--    <!-- Theme JS files -->--}}
{{--    <script src="{{ asset('js/custom.js') }}"></script>--}}
{{--    <script src="{{ asset('js/select2.js') }}"></script>--}}
{{--    <!-- /theme JS files -->--}}

    <script src="{{ asset('js/vendors/jquery-3.2.1.min.js') }}"></script>
    <script src="{{ asset('js/vendors/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('js/vendors/jquery.sparkline.min.js') }}"></script>
    <script src="{{ asset('js/vendors/selectize.min.js') }}"></script>
    <script src="{{ asset('js/vendors/jquery.tablesorter.min.js') }}"></script>
    <script src="{{ asset('js/vendors/circle-progress.min.js') }}"></script>


    <!-- Fullside-menu Js-->
    <script src="{{ asset('plugins/toggle-sidebar/js/sidemenu.js') }}"></script>

    <!-- Data tables -->
    <script src="{{ asset('plugins/datatable/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('plugins/datatable/dataTables.bootstrap4.min.js') }}"></script>

    <!--Select2 js -->
    <script src="{{ asset('plugins/select2/select2.full.min.js') }}"></script>

    <!-- Timepicker js -->
    <script src="{{ asset('plugins/time-picker/jquery.timepicker.js') }}"></script>
    <script src="{{ asset('plugins/time-picker/toggles.min.js') }}"></script>

    <!-- Datepicker js -->
    <script src="{{ asset('plugins/date-picker/spectrum.js') }}"></script>
    <script src="{{ asset('plugins/date-picker/jquery-ui.js') }}"></script>
    <script src="{{ asset('plugins/input-mask/jquery.maskedinput.js') }}"></script>

    <!-- file uploads js -->
    <script src="{{ asset('plugins/fileuploads/js/dropify.min.js') }}"></script>

    <!-- Inline js -->
    <script src="{{ asset('js/select2.js') }}"></script>
    <!---Tabs JS-->
    <script src="{{ asset('plugins/tabs/jquery.multipurpose_tabcontent.js') }}"></script>

    <!-- Custom scroll bar Js-->
    <script src="{{ asset('plugins/scroll-bar/jquery.mCustomScrollbar.concat.min.js') }}"></script>

    <!-- Custom Js-->
    <script src="{{ asset('js/custom.js') }}"></script>

</head>
<body class="app sidebar-mini rtl">
<div id="global-loader"></div>
<div class="page">
    <div class="page-main">
        <!-- Main navbar -->
        @include('admin.layout.navbar')
        <!-- /main navbar -->
        <!-- Sidebar area -->
        @include('admin.layout.sidebar')
        <!-- /Sidebar area -->

        <!-- Content area -->
        <div class="app-content my-3 my-md-5">
            @yield('content')

            @include('admin.layout.footer')
        </div>
        <!-- /content area -->
    </div>
    <input type="hidden" id="home_path" value="<?=url('');?>">
</div>
<!-- /page content -->
<!-- Back to top -->
<a href="#top" id="back-to-top" style="display: inline;"><i class="fa fa-angle-up"></i></a>
@yield('page-js')

</body>

</html>
