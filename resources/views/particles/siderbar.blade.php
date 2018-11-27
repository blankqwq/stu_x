<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ $user->avatar  }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ $user->name  }}</p>
                <a href="#"><i class="fa fa-circle text-success"></i>{{ $user->sign  }} </a>
            </div>
        </div>
        <!-- search form -->
        {{--//搜索框--}}
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">主菜单</li>
            <li class=" treeview {{active_class(if_route('stu.home'))}} ">
                <a href="#">
                    <i class="fa fa-dashboard"></i> <span>仪表盘</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{active_class(if_route('stu.home'))}}"><a href="/home"><i class="fa fa-circle-o"></i> 首页</a></li>
                </ul>
            </li>
            <li class="treeview {{active_class(if_route('classes.index')|| if_route('classes.create') || if_route('classes.join') || if_route('classes.my') )}}">
                <a href="#">
                    <i class="fa fa-pie-chart"></i>
                    <span>班级系统</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="{{ active_class(if_route('classes.index')) }}"><a href="{{route('classes.index')}}"><i class="fa fa-circle-o"></i> 全部 班级</a></li>
                    <li class="{{ active_class(if_route('classes.create')) }}"><a href="{{route('classes.create')}}"><i class="fa fa-circle-o"></i> 创建 班级</a></li>
                    <li class="{{ active_class(if_route('classes.join')) }}"><a href="{{route('classes.join')}}"><i class="fa fa-circle-o"></i> 我的班级</a></li>
                    <li class="{{ active_class(if_route('classes.my')) }}"><a href="{{route('classes.my')}}"><i class="fa fa-circle-o"></i> 我创建的班级</a></li>
                </ul>
            </li>
            <li class="treeview {{active_class(if_route('users.index')  || if_route('users.edit') || if_route('users.show') ||if_route('users.search'))}}">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>用户管理系统</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu ">
                    <li class="{{active_class(if_route('users.search'))}}"><a href="{{route('users.search')}}"><i class="fa fa-circle-o"></i> 用户搜索</a></li>
                    <li class="{{active_class(if_route('users.index'))}}"><a href="{{route('users.index')}}"><i class="fa fa-circle-o"></i> 我的信息</a></li>
                    <li class="{{active_class(if_route('users.edit'))}}"><a href="{{route('users.edit',$user->id)}}"><i class="fa fa-circle-o"></i> 信息编辑</a></li>
                </ul>
            </li>
            <li class="treeview @yield('message')">
                <a href="#">
                    <i class="fa fa-envelope"></i>
                    <span>私信系统</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class=" @yield('message-noread')"><a href="/message/index.html"><i class="fa fa-circle-o"></i> 未读信息</a></li>
                    <li class=" @yield('message-read')"><a href="/message/receive.html"><i class="fa fa-circle-o"></i> 已读消息</a></li>
                    <li class=" @yield('message-post')"><a href="/message/send.html"><i class="fa fa-circle-o"></i> 发布消息</a></li>
                    <li class=" @yield('message-posted')"><a href="/message/outbox.html"><i class="fa fa-circle-o"></i> 已发布</a></li>
                    <li class=" @yield('message-trash')"><a href="/message/trash.html"><i class="fa fa-circle-o"></i> 消息回收站</a></li>
                </ul>
            </li>
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-edit"></i> <span>问答系统</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="pages/forms/general.html"><i class="fa fa-circle-o"></i> 在线提问</a></li>--}}
                    {{--<li><a href="pages/forms/advanced.html"><i class="fa fa-circle-o"></i> 问题列表</a></li>--}}
                    {{--<li><a href="pages/forms/editors.html"><i class="fa fa-circle-o"></i> 系统管理</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li class="treeview">--}}
                {{--<a href="#">--}}
                    {{--<i class="fa fa-table"></i> <span>答题系统</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<i class="fa fa-angle-left pull-right"></i>--}}
            {{--</span>--}}
                {{--</a>--}}
                {{--<ul class="treeview-menu">--}}
                    {{--<li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> 最近任务</a></li>--}}
                    {{--<li><a href="pages/tables/simple.html"><i class="fa fa-circle-o"></i> 在线测试</a></li>--}}
                    {{--<li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> 答题管理</a></li>--}}
                    {{--<li><a href="pages/tables/data.html"><i class="fa fa-circle-o"></i> 发布答题</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
            {{--<li>--}}
                {{--<a href="pages/calendar.html">--}}
                    {{--<i class="fa fa-calendar"></i> <span>日历</span>--}}
                    {{--<span class="pull-right-container">--}}
              {{--<small class="label pull-right bg-red">3</small>--}}
              {{--<small class="label pull-right bg-blue">17</small>--}}
            {{--</span>--}}
                {{--</a>--}}
            {{--</li>--}}

            <li class="treeview  @yield('files')">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>文件管理</span>
                    <span class="pull-right-container">
              <i class="fa fa-angle-left pull-right"></i>
            </span>
                </a>
                <ul class="treeview-menu">
                    <li class="@yield('files-class')"><a href="/classfile"><i class="fa fa-circle-o"></i> 班级文件</a></li>
                    <li class="@yield('files-me')"><a href="/filesystem"><i class="fa fa-circle-o"></i> 我的文件</a></li>
                </ul>
            </li>

            <li class="header">LABELS</li>
            @role('master|admin')
            <li><a href="/admin/users"><i class="fa fa-circle-o text-yellow"></i> <span>后台管理</span></a></li>
            @endrole
            <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> <span>Warning</span></a></li>
            <li><a href="#"><i class="fa fa-circle-o text-aqua"></i> <span>Information</span></a></li>
        </ul>
    </section>
</aside>