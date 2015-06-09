<li class="dropdown navbar-user">
    <a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-user fa-fw"></i>
        <span class="hidden-xs">{{ $user->name ?: 'admin' }} </span> <b class="caret"></b>
    </a>
    <ul class="dropdown-menu animated fadeInLeft">
        <li class="arrow"></li>
        {{--
        <li><a href="javascript:;">Edit Profile</a></li>
        <li><a href="javascript:;"><span class="badge badge-danger pull-right">2</span> Inbox</a></li>
        <li><a href="javascript:;">Calendar</a></li>
        <li><a href="javascript:;">Setting</a></li>
        <li class="divider"></li>
        --}}
        <li><a href="{{ Admin::instance()->router->routeToAuth('logout') }}"><i class="fa fa-sign-out fa-fw"></i> {{ Lang::get('admin::lang.auth.logout') }}</a></li>
    </ul>
</li>