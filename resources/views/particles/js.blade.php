<script src="{{ asset('admin/bower_components/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/jquery-ui/jquery-ui.min.js') }}"></script>
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="{{ asset('admin/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('admin/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js') }}"></script>
<script src="{{ asset('admin/bower_components/jquery-slimscroll/jquery.slimscroll.min.js') }}"></script>
<script src="{{ asset('admin/dist/js/adminlte.min.js') }}"></script>

<script>
    function a(){
        htmlobj1 = $.ajax(
            {
                type: "GET",
                url: "{{route('messages.pm')}}",
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
                url: "{{route('messages.request')}}",
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
                url: "{{route('messages.reply')}}",
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
                    url: "{{route('messages.pm')}}",
                    success: function () {
                        $('#shixing').empty();
                        $('#shixing').html(htmlobj1.responseText);
                    },
                    error: function () {
                    }

                })}, 10000);
        setInterval(function () {
        htmlobj2 = $.ajax(
            {
                type: "GET",
                url: "{{route('messages.request')}}",
                success: function () {
                    $('#shengqing').empty();
                    $('#shengqing').html(htmlobj2.responseText);
                },
                error: function () {
                }

            })}, 10000);
    setInterval(function () {
        htmlobj3 = $.ajax(
            {
                type: "GET",
                url: "{{route('messages.reply')}}",
                success: function () {
                    $('#banji').empty();
                    $('#banji').html(htmlobj3.responseText);
                },
                error: function () {
                }
            })}, 10000);



</script>
@yield('js')