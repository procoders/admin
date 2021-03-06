<?php namespace SleepingOwl\Admin\Menu;

use SleepingOwl\Admin\Admin;
use SleepingOwl\Html\HtmlBuilder;
use SleepingOwl\Admin\Router;
use SleepingOwl\AdminAuth\Facades\AdminAuth;
use Illuminate\Support\Arr;
use \App\Models\Administrator;

/**
 * Class MenuItem
 */
class MenuItem
{
	/**
	 * @var MenuItem
	 */
	public static $current;
	/**
	 * @var HtmlBuilder
	 */
	protected $htmlBuilder;
	/**
	 * @var string
	 */
	protected $modelClass;
	/**
	 * @var string
	 */
	protected $label;
	/**
	 * @var string
	 */
	protected $icon;
	/**
	 * @var string
	 */
	protected $uses;
	/**
	 * @var string
	 */
	protected $url;
	/**
	 * @var MenuItem[]
	 */
	protected $subItems;
	/**
	 * @var Router
	 */
	protected $router;
	/**
	 * @var bool
	 */
	protected $hidden = false;

    /**
     * @var bool
     */
    protected $separator = false;

    /**
     * @return bool
     */
    public function isHidden()
    {
        return $this->hidden;
    }

	/**
	 * @param string|null $modelClass
	 */
	function __construct($modelClass = null)
	{
		$admin = Admin::instance();
		$this->router = $admin->router;
		$this->htmlBuilder = $admin->htmlBuilder;
		$this->modelClass = $modelClass;
		$this->subItems = [];
		if (is_null(static::$current))
		{
			static::$current = $this;
		} else
		{
			static::$current->addItem($this);
		}
	}

	/**
	 * @param string $label
	 * @return $this
	 */
	public function label($label)
	{
		$this->label = $label;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getLabel()
	{
		if ( ! is_null($this->label)) return $this->label;

		return $this->getModelItem()->getTitle();
	}

	/**
	 * @param string $icon
	 * @return $this
	 */
	public function icon($icon)
	{
		$this->icon = $icon;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getIcon()
	{
		return $this->icon;
	}

	/**
	 * @return string
	 */
	public function getUses()
	{
		return $this->uses;
	}

	/**
	 * @param string $uses
	 * @return $this
	 */
	public function uses($uses)
	{
		$this->uses = $uses;
		return $this;
	}

	/**
	 * @param string $url
	 * @return $this
	 */
	public function url($url)
	{
		$this->url = $url;
		return $this;
	}

	/**
	 * @return string
	 */
	public function getUrl()
	{
		if ( ! is_null($this->url))
		{
			if (strpos($this->url, '://') !== false)
			{
				return $this->url;
			}
			return $this->router->routeToWildcard($this->url);
		}
		if ( ! is_null($this->modelClass))
		{
			return $this->router->routeToModel($this->getModelItem()->getAlias());
		}
		return '#';
	}

	/**
	 * @param \Closure $callback
	 * @return $this
	 */
	public function items($callback)
	{
		$old = static::$current;
		static::$current = $this;
		call_user_func($callback);
		static::$current = $old;
		return $this;
	}

	/**
	 * @return bool
	 */
	public function hasSubItems()
	{
		return count($this->subItems) != 0;
	}

	/**
	 * @param $url
	 * @return $this
	 */
	public function itemWithUrl($url)
	{
		if ($this->url === $url) return $this;
		foreach ($this->subItems as $item)
		{
			if ($result = $item->itemWithUrl($url))
			{
				return $result;
			}
		}
		return null;
	}

	/**
	 * @return MenuItem[]
	 */
	public function getItems()
	{
		return $this->subItems;
	}

	/**
	 * @param MenuItem $item
	 * @return $this
	 */
	public function addItem($item)
	{
		$this->subItems[] = $item;
		return $this;
	}

	/**
	 * @return \SleepingOwl\Admin\Models\ModelItem
	 * @throws \SleepingOwl\Admin\Exceptions\ModelNotFoundException
	 */
	protected function getModelItem()
	{
		return Admin::instance()->models->modelWithClassname($this->modelClass);
	}

    public function getSubUrls()
    {
        return array_map(function($i) {
            return $i->getUrl();
        }, (array)$this->subItems);
    }

	/**
	 * @param int $level
	 * @return string
	 */
	public function render($level = 1)
	{
        if ($this->isHidden())
            return true;

        return view('admin::_partials.side_bar.item')
            ->with('icon', $this->getIcon())
            ->with('title', $this->getLabel())
            ->with('link', $this->getUrl())
            ->with('subItems', $this->subItems)
            ->with('item', $this);
	}

	/**
	 * @return string
	 */
	protected function renderSingleItem()
	{
		$content = $this->htmlBuilder->tag('i', [
			'class' => [
				'fa',
				'fa-fw',
				$this->getIcon()
			]
		]);
		$content .= ' ' . $this->getLabel();
		return $this->htmlBuilder->tag('a', ['href' => $this->getUrl()], $content);
	}

	/**
	 * @param bool $hidden
	 * @return $this
	 */
	public function hidden($hidden = true)
	{
		$this->hidden = $hidden;
		return $this;
	}

    public function separator($val)
    {
        $this->separator = (bool)$val;
    }

    public function isSeparator()
    {
        return $this->separator;
    }
}