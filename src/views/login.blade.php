@extends('admin::_layout.base')

@section('content')
    <div id="page-loader" class="fade in"><span class="spinner"></span></div>

    <div class="login-cover">
        <div class="login-cover-image" style="background: url('{{Admin::instance()->router->routeToAsset('img/login-bg/bg-3.jpg')}}'); background-size: cover;"></div>
        <div class="login-cover-bg"></div>
    </div>
    <div id="page-container" class="fade">
        <div class="login login-v2" data-pageload-addclass="animated fadeIn">
            <div class="login-header">
                <div class="brand">
                    One Hotel
                    <small>{{ Lang::get('admin::lang.auth.title') }}</small>
                </div>
                <div class="icon">
                    <i class="fa fa-sign-in"></i>
                </div>
            </div>
            <div class="login-content">
                <form action="{{$loginPostUrl}}" method="POST" class="margin-bottom-0">
                    <div class="form-group m-b-20">
                        <input type="text" class="form-control input-lg" name="username" placeholder="{{ Lang::get('admin::lang.auth.username') }}" />
                    </div>
                    <div class="form-group m-b-20">
                        <input type="password" class="form-control input-lg" name="password" placeholder="{{ Lang::get('admin::lang.auth.password') }}" />
                    </div>
                    <div class="login-buttons">
                        <button type="submit" class="btn btn-success btn-block btn-lg">Sign me in</button>
                    </div>
                    <div class="m-t-20">
                        Not a member yet? Click <a href="/registration">here</a> to register.
                    </div>
                </form>
            </div>
        </div>
        <ul class="login-bg-list">
            <li><a href="#" data-click="change-bg"><img src="{{Admin::instance()->router->routeToAsset('img/login-bg/bg-1.jpg')}}" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="{{Admin::instance()->router->routeToAsset('img/login-bg/bg-2.jpg')}}" alt="" /></a></li>
            <li class="active"><a href="#" data-click="change-bg"><img src="{{Admin::instance()->router->routeToAsset('img/login-bg/bg-3.jpg')}}" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="{{Admin::instance()->router->routeToAsset('img/login-bg/bg-4.jpg')}}" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="{{Admin::instance()->router->routeToAsset('img/login-bg/bg-5.jpg')}}" alt="" /></a></li>
            <li><a href="#" data-click="change-bg"><img src="{{Admin::instance()->router->routeToAsset('img/login-bg/bg-6.jpg')}}" alt="" /></a></li>
        </ul>
    </div>
    <?php AssetManager::addScript('admin::js/login.js'); ?>
    <script>
        $(document).ready(function() {
            App.init();
            LoginV2.init();
        });
    </script>
@stop

