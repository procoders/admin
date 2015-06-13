<?php namespace SleepingOwl\Admin\ViewFilters;

use App;
use SleepingOwl\Admin\ViewFilters\Interfaces\ViewFilterInterface;
use Illuminate\Support\Arr;
use SleepingOwl\Admin\Models\ModelItem;

/**
 * Class ViewFilter
 * @package SleepingOwl\Admin\ViewFilters
 */
class ViewFilter
{
	/**
	 * @var array
	 */
	protected static $handlers = [];

	/**
	 * @param string $method
	 * @param $params
	 * @return ViewFiltersInterface
	 */
	public static function __callStatic($method, $params)
	{
        $filter = null;
		if ($handler = static::getHandler($method)) {
            $filter = App::make($handler, $params);
		} else {
			$className = get_called_class() . '\\' . ucfirst($method);
            $filter = new $className(Arr::get($params, 0, null), Arr::get($params, 1, null));
		}

        ModelItem::$current->addViewFilter($filter);

		return $filter;
	}

	/**
	 * @param $name
	 * @param string $handler
	 */
	public static function register($name, $handler)
	{
		static::$handlers[$name] = $handler;
	}

	/**
	 * @param $method
	 * @return string|null
	 */
	protected static function getHandler($method)
	{
		return Arr::get(static::$handlers, $method, null);
	}
}