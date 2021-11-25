

<header class="main-header">
    <!-- Logo -->
    <a href="{{URL::to('/')}}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>Hotel </b>Software</span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>Hotel </b>Software</span>
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
                <li class="dropdown messages-menu" style="visibility: hidden;">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <i class="fa fa-language"></i>
                    </a>
                    <ul class="dropdown-menu">
                        <li>
                            <!-- inner menu: contains the actual data -->
                            {{-- <ul class="menu">
                                @php
                                $en_switch = str_replace('bn', 'en', url()->current());
                                $bn_switch = str_replace('en', 'bn', url()->current());
                                @endphp
                                <li>
                                    <a href="{{URL::to($en_switch)}}">
                                        <h4> EN </h4>
                                    </a>
                                </li>
                                <!-- end message -->
                                <li>
                                    <a href="{{URL::to($bn_switch)}}">
                                        <h4> BN </h4>
                                    </a>
                                </li>
                            </ul> --}}
                            {{-- <ul class="menu">
                                <li>
                                    <a href="{{route('set-locale', 'en')}}">
                                        <h4> EN </h4>
                                    </a>
                                </li>
                                <!-- end message -->
                                <li>
                                    <a href="{{route('set-locale', 'bn')}}">
                                        <h4> BN </h4>
                                    </a>
                                </li>
                            </ul> --}}
                        </li>
                    </ul>
                </li>
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    <img src="{{asset(auth()->user()->photo)}}" class="user-image" alt="User Image">
                    <span class="hidden-xs">{{auth()->user()->name}}</span>
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            <img src="{{asset(auth()->user()->photo)}}" class="img-circle" alt="User Image">
                            <p>
                                {{auth()->user()->name}}
                                <small>Member since {{auth()->user()->created_at->toFormattedDateString()}}</small>
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                <a href="{{route('profile')}}" class="btn btn-default btn-flat">{{__('Profile')}}</a>
                            </div>
                            <div class="pull-right">
                                <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="btn btn-default btn-flat">{{__('Sign out')}}</a>
                                
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;"> @csrf </form>
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

