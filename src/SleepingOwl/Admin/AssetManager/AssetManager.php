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
        'admin::assets/plugins/bootstrap/css/bootstrap.min.css',
        'admin::assets/plugins/jquery-ui/themes/base/minified/jquery-ui.min.css',
        'admin::assets/plugins/font-awesome/css/font-awesome.min.css',
        'admin::assets/css/animate.min.css',
        'admin::assets/css/style.min.css',
        'admin::assets/css/style-responsive.min.css',
        'admin::assets/css/theme/default.css',
    ];
	/**
	 * Scripts array to include on every admin page
	 * @var array
	 */
	protected static $scripts = [
        'admin::assets/plugins/jquery/jquery-1.9.1.min',
	    'admin::assets/plugins/pace/pace.min.js'
    ];

	public static function styles()
	{
		return static::assets(static::$styles);
	}

	public static function addStyle($style)
	{
		static::$styles[] = $style;
	}

	public static function scripts()
	{
		$scripts = static::assets(static::$scripts);
		array_unshift($scripts, Admin::instance()->router->routeToLang(App::getLocale()));
		return $scripts;
	}

	public static function addScript($script)
	{
		static::$scripts[] = $script;
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
				return Admin::instance()->router->routeToAsset($asset);
			}
			return $asset;
		}, array_unique($assets));
	}
} 