<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('admin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<!-- Bootstrap 3.3.7 -->
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<!-- Morris.js charts -->
{{--<script src="{{ asset('admin/bower_components/raphael/raphael.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/bower_components/morris.js/morris.min.js') }}"></script>--}}
<!-- Sparkline -->
{{--<script src="{{ asset('admin/bower_components/jquery-sparkline/dist/jquery.sparkline.min.js') }}"></script>--}}
<!-- jvectormap -->
{{--<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/plugins/jvectormap/jquery-jvectormap-world-mill-en.js') }}"></script>--}}
<!-- jQuery Knob Chart -->
{{--<script src="{{ asset('admin/bower_components/jquery-knob/dist/jquery.knob.min.js') }}"></script>--}}
<!-- daterangepicker -->
{{--<script src="{{ asset('admin/bower_components/moment/min/moment.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>--}}
<!-- datepicker -->
{{--<script src="{{ asset('admin/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js') }}"></script>--}}
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<!-- Slimscroll -->
<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<!-- FastClick -->
{{--<script src="{{ asset('admin/bower_components/fastclick/lib/fastclick.js') }}"></script>--}}
<!-- AdminLTE App -->
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
{{--<script src="{{ asset('admin/dist/js/pages/dashboard.js') }}"></script>--}}
<!-- AdminLTE for demo purposes -->
{{--<script src="{{ asset('admin/dist/js/demo.js') }}"></script>--}}
<script>
    function a(){
        htmlobj1 = $.ajax(
            {
                type: "GET",
                url: "{{url('/message/getshixing')}}",
                success: function () {
                    $('#shixing').empty();
                    $('#shixing').html(htmlobj1.responseText);
                },
                error: function () {
                }

            });
        htmlobj2 = $.ajax(
            {
                type: "GET",
                url: "{{url('/message/shengqing')}}",
                success: function () {
                    $('#shengqing').empty();
                    $('#shengqing').html(htmlobj2.responseText);
                },
                error: function () {
                }

            });
        htmlobj3 = $.ajax(
            {
                type: "GET",
                url: "{{url('/message/banji')}}",
                success: function () {
                    $('#banji').empty();
                    $('#banji').html(htmlobj3.responseText);
                },
                error: function () {
                }

            });
    }
    a();

        setInterval(function () {
            htmlobj1 = $.ajax(
                {
                    type: "GET",
                    url: "{{url('/message/getshixing')}}",
                    success: function () {
                        $('#shixing').empty();
                        $('#shixing').html(htmlobj1.responseText);
                    },
                    error: function () {
                    }

                });

        }, 10000);
    setInterval(function () {
    htmlobj2 = $.ajax(
        {
            type: "GET",
            url: "{{url('/message/shengqing')}}",
            success: function () {
                $('#shengqing').empty();
                $('#shengqing').html(htmlobj2.responseText);
            },
            error: function () {
            }

        });
    htmlobj3 = $.ajax(
        {
            type: "GET",
            url: "{{url('/message/banji')}}",
            success: function () {
                $('#banji').empty();
                $('#banji').html(htmlobj3.responseText);
            },
            error: function () {
            }

        });},8000);



</script>
@yield('js')