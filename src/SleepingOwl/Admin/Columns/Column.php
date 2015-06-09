<?php namespace SleepingOwl\Admin\Columns;

use App;
use SleepingOwl\Admin\Columns\Interfaces\ColumnInterface;
use Illuminate\Support\Arr;
use SleepingOwl\Admin\Models\ModelItem;

/**
 * Class Column
 *
 * @method static Column\Image image($name, $label = null)
 * @method static Column\String string($name, $label = null)
 * @method static Column\Date date($name, $label = null)
 * @method static Column\Lists lists($name, $label = null)
 * @method static Column\Count count($name, $label = null)
 * @method static Column\Control control()
 * @method static Column\Filter filter($alias)
 * @method static Column\Url url($name)
 * @method static Column\Action action($name, $label = null)
 */
class Column
{
	/**
	 * @var array
	 */
	protected static $handlers = [];

	/**
	 * @param string $method
	 * @param $params
	 * @return ColumnInterface
	 */
	public static function __callStatic($method, $params)
	{
		$column = null;
		if ($handler = static::getHandler($method))
		{
			$column = App::make($handler, $params);
		} else
		{
			$className = get_called_class() . '\\' . ucfirst($method);
			$column = new $className(Arr::get($params, 0, null), Arr::get($params, 1, null));
		}
		if ( ! $column->isHidden())
		{
			ModelItem::$current->addColumn($column);
		}

		return $column;
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