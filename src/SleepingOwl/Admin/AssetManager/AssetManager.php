<?php namespace SleepingOwl\Admin\AssetManager;

use AdminAuth;
use App;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\Router;

class AssetManager
{
	/**
	 * Styles array to include on every admin page
	 * @var array
	 */
	protected static $styles = [
        'admin::css/bootstrap.min.css',
        'admin::css/jquery-ui.min.css',
        'admin::css/font-awesome.min.css',
        'admin::css/animate.min.css',
        'admin::css/style.min.css',
        'admin::css/style-responsive.min.css',
        'admin::css/theme/default.css',
    ];
	/**
	 * Scripts array to include on every admin page
	 * @var array
	 */
	protected static $scripts = [
        'admin::js/jquery-1.9.1.min.js',
	    'admin::js/pace.min.js',
        'admin::js/jquery-migrate-1.1.0.min.js',
        'admin::js/jquery-ui.min.js',
        'admin::js/jquery.slimscroll.min.js',
        'admin::js/jquery.cookie.js',
        'admin::js/jquery.gritter.min.js',
        'admin::js/jquery.flot.min.js',
        'admin::js/jquery.flot.time.min.js',
        'admin::js/jquery.flot.resize.min.js',
        'admin::js/jquery.flot.pie.min.js',
        'admin::js/jquery.sparkline.js',
        'admin::js/jquery-jvectormap-1.2.2.min.js',
        'admin::js/jquery-jvectormap-world-mill-en.js',
        'admin::js/bootstrap.min.js',
        'admin::js/apps.js'
    ];

	public static function styles()
	{
		return static::assets(static::$styles);
	}

	public static function addStyle($style)
	{
		static::$styles[] = $style . '?ver=' . time();
	}

	public static function scripts()
	{
		$scripts = static::assets(static::$scripts);
		array_unshift($scripts, Admin::instance()->router->routeToLang(App::getLocale()) . '?ver=' . time());
		return $scripts;
	}

	public static function addScript($script)
	{
		static::$scripts[] = $script . '?ver=' . time();
	}

	/**
	 * @param $assets
	 * @return array
	 */
	protected static function assets($assets)
	{
		return array_map(function ($asset)
		{
			if (strpos($asset, 'admin::') !== false)
			{
				$asset = str_replace('admin::', '', $asset);

                $pathToAsset = public_path() . DIRECTORY_SEPARATOR .
                    'packages' . DIRECTORY_SEPARATOR .
                    'sleeping-owl' . DIRECTORY_SEPARATOR .
                    'admin' . DIRECTORY_SEPARATOR .
                    $asset;
                if (file_exists($pathToAsset)) {
                    $asset .= '?ver=' . filemtime($pathToAsset);
                }

				return Admin::instance()->router->routeToAsset($asset);
			}
			return $asset;
		}, array_unique($assets));
	}
} 