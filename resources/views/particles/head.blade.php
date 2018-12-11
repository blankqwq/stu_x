<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>@yield('title', 'stu') - {{ setting('site_name', 'stu系统') }}</title>
    <meta name="description" content="@yield('description', setting('seo_description', 'stu'))" />
    <meta name="keyword" content="@yield('keyword', setting('seo_keyword', 'stu'))" />
    <link rel="icon" href="@yield('icon', setting('site_icon', '/storage/uploads/images/default.ico'))" type="img/x-ico" />
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/AdminLTE.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/dist/css/skins/_all-skins.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/morris.js/morris.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/jvectormap/jquery-jvectormap.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.css') }}">
    <link rel="stylesheet" href="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css') }}">
    <script src="https://lib.baomitu.com/jquery/3.3.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    @yield('css')
</head>