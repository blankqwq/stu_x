<header class="main-header">
    <!-- Logo -->
    <a href="/" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>{{ setting('school_name', 'stu') }}</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>{{ setting('school_name', 'stu') }}</b></span>
    </a>

    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                <!-- Messages: style can be found in dropdown.less-->
                <li class="dropdown messages-menu" id="shixing">

                </li>
                <!-- Notifications: style can be found in dropdown.less -->
                <li class="dropdown notifications-menu" id="banji">

                </li>
                <!-- Tasks: style can be found in dropdown.less -->
                <li class="dropdown tasks-menu" id="shengqing">

                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="/users/me" class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ $user->avatar  }}" class="user-image" alt="User Image">
                        <span class="hidden-xs">{{ $user->name  }}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{ $user->avatar  }}" class="img-circle" alt="User Image">

                            <p>
                                {{ $user->name  }}
                                <small>{{ $user->sign }}</small>
                            </p>
                        </li>
                        <!-- Menu Body -->
                        <li class="user-body">
                            <div class="row">
                                <div class="col-xs-4 text-center">
                                    <a href="{{route('users.index')}}">信息</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="#">~~~~</a>
                                </div>
                                <div class="col-xs-4 text-center">
                                    <a href="/classes/me">班级</a>
                                </div>
                            </div>
                            <!-- /.row -->
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="#" class="btn btn-default btn-flat">Profile</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" class="btn btn-default btn-flat"
                                   onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                    Logout
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                      style="display: none;">
                                    {{ csrf_field() }}
                                </form>
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
                <li>
                    <a href="#" data-toggle="control-sidebar"><i class="fa fa-gears"></i></a>
                </li>
            </ul>
        </div>
    </nav>

</header>