<div class="col-md-9">
    <script>


        var wsUrl = "ws://{{config('code.url')}}:9500/?class={{$classe->id}}";

        var websocket = new WebSocket(wsUrl);
        var h = 1000;
        websocket.onopen = function (evt) {
            var data = {'type': 'connect', 'class_id':{{$classe->id}}, 'user_id':{{$user->id}}};
            websocket.send(JSON.stringify(data));
            console.log("conected-swoole-success");
        }

        // 实例化 onmessage
        websocket.onmessage = function (evt) {
            console.log("ws-server-return-data:" + evt.data);
            var data = JSON.parse(evt.data);
            if (data.type == "message")
                pushmessage(data)
            if (data.type == "connect")
                pushconnect(data)
            if (data.type == "quit")
                pushquit(data)

        }

        //onclose
        websocket.onclose = function (evt) {
            console.log("close");

        }
        //onerror

        websocket.onerror = function (evt, e) {
            console.log("error:" + evt.data);
        }

        function pushmessage(data) {

            var html = '<div class="item">';
            html += '<img src="' + data.avatar + '" alt="user image" class="online">';
            html += '<p class="message"> <a href="#" class="name"> <small class="text-muted pull-right">';
            html += '<i class="fa fa-clock-o"></i>' + data.created_at + '</small>';
            html += data.name + '</a>';
            html += data.content + '</p> </div>';
            $('#chat-box').append(html);
            $(function () {
                h += $(".item").height();
                $("#chat-box").scrollTop(h);
            });
            $('#chart_box').val("")
        }

        function pushconnect(data) {

            var html = '<div class="item">';
            html += '<figure class="highlight"><pre> ';
            html += '欢迎' + data.name + '加入此班级的聊天室</pre></figure>';
            $('#chat-box').append(html);
            $(function () {
                h += $(".item").height();
                $("#chat-box").scrollTop(h);
            });
        }

        function pushquit(data) {

            var html = '<div class="item">';
            html += '<figure class="highlight"><pre> ';
            html += data.name + '已离开聊天室</pre></figure>';
            $('#chat-box').append(html);
            $(function () {
                h += $(".item").height();
                $("#chat-box").scrollTop(h);
            });
        }

        $(function () {
            $('#chart_box').keydown(function (event) {
                if (event.keyCode == 13) {
                    var text = $(this).val();
                    if (text == null || text == '') {
                        alert("请勿发送空消息");
                    } else {
                        var data = {
                            'type': 'message',
                            'content': text,
                            'class_id':{{$classe->id}},
                            'user_id':{{$user->id}}};
                        websocket.send(JSON.stringify(data));
                    }
                }
            });

            $('#chart_quit').click(function (evt) {
                var data = {'type': 'quit', 'class_id':{{$classe->id}}, 'user_id':{{$user->id}}};
                websocket.send(JSON.stringify(data));
                websocket.close();
            });

            $(window).bind('beforeunload', function () {
                var data = {'type': 'quit', 'class_id':{{$classe->id}}, 'user_id':{{$user->id}}};
                websocket.send(JSON.stringify(data));
                websocket.close();
            });
        });
    </script>

    <div class="box box-success">
        <div class="box-header ui-sortable-handle" style="cursor: move;">
            <i class="fa fa-comments-o"></i>

            <h3 class="box-title">Chat</h3>

            <div class="box-tools pull-right" data-toggle="tooltip" title="" data-original-title="Status">
                <div class="btn-group" data-toggle="btn-toggle">
                    <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i>
                    </button>
                    <button type="button" id="chart_quit" class="btn btn-default btn-sm"><i
                                class="fa fa-square text-red"></i></button>
                </div>
            </div>
        </div>
        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 500px;">
            <div class="box-body chat" id="chat-box" style="overflow: auto; width: auto; height: 500px;">
            @foreach($charts as $chart)
                <div class="item">
                    <img src=" {{$chart->user->avatar}}"  alt="user image" class="online">
                    <p class="message">
                        <a href="#" class="name">
                            <small class="text-muted pull-right"><i class="fa fa-clock-o"></i>{{$chart->created_at}}</small>
                            {{$chart->user->name}}
                        </a>
                        {{$chart->content}}
                    </p>
                </div>
            @endforeach
            </div>
            <div class="slimScrollBar"
                 style="background: rgb(0, 0, 0); width: 7px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 1px; height: 224.82px;"></div>
            <div class="slimScrollRail"
                 style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 1px;"></div>
        </div>
        <div class="box-footer">
            <div class="input-group">
                <input id="chart_box" class="form-control" placeholder="Type message...">

                <div class="input-group-btn">
                    <button id="chart_send" type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
                </div>
            </div>
        </div>
    </div>
</div>