@extends('admin::_layout.base')

@section('content')
	<div id="page-container" class="fade page-sidebar-fixed page-header-fixed in">
        <div id="header" class="header navbar navbar-default navbar-fixed-top">
            <!-- begin container-fluid -->
            <div class="container-fluid">
                <!-- begin mobile sidebar expand / collapse button -->
                <div class="navbar-header">
                    <a class="navbar-brand" href="{{ Admin::instance()->router->routeHome() }}">{{{ $adminTitle }}}</a>
                    <button type="button" class="navbar-toggle" data-click="sidebar-toggled">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <!-- end mobile sidebar expand / collapse button -->

                @include('admin::_partials.menu')
            </div>
            <!-- end container-fluid -->
        </div>
		<div id="page-wrapper">
            @include('admin::_partials.sidebar')
			@yield('innerContent')
		</div>
	</div>
@stop