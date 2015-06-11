<?php namespace SleepingOwl\Admin\Columns\Column;

use SleepingOwl\Admin\Admin;
use SleepingOwl\Html\FormBuilder;
use Lang;
use SleepingOwl\Models\Interfaces\ModelWithOrderFieldInterface;

class Control extends BaseColumn
{
    const EDIT_BUTTON = 'EDIT_BUTTON';
    const DELETE_BUTTON = 'DELETE_BUTTON';

	/**
	 * @var \SleepingOwl\Admin\Router
	 */
	protected $router;
	/**
	 * @var FormBuilder
	 */
	protected $formBuilder;

	/**
	 *
	 */
	function __construct()
	{
		parent::__construct('control-column', '');
		$admin = Admin::instance();
		$this->router = $admin->router;
		$this->formBuilder = $admin->formBuilder;
	}

	/**
	 * @param $instance
	 * @param int $totalCount
	 * @return string
	 */
	public function render($instance, $totalCount)
	{

		$buttons = [];
		if ( ! $this->modelItem->isOrderable())
		{
			$buttons[] = $this->moveButtons($instance, $totalCount);
		}
		$buttons[] = $this->editButton($instance, $this->modelItem->isEditable($instance));
		$buttons[] = $this->destroyButton($instance, $this->modelItem->isDeletable($instance));
		return $this->htmlBuilder->tag('td', ['class' => 'text-right'], implode(' ', $buttons));
	}

	/**
	 * @param $instance
	 * @param bool $active
	 * @return string
	 */
	protected function editButton($instance, $active = true)
	{
        if ($active == false)
            return '';

        return view('admin::_partials.button')
            ->with('type', self::EDIT_BUTTON)
            ->with('link', $this->router->routeToEdit($this->modelItem->getAlias(), $instance->getKey()))
            ->with('data-toggle', 'tooltip')
            ->with('title', Lang::get('admin::lang.table.edit'));
	}

	/**
	 * @param $instance
	 * @param bool $active
	 * @return string
	 */
	protected function destroyButton($instance, $active = true)
	{
        if ($active == false)
            return '';

        return view('admin::_partials.button')
            ->with('type', self::DELETE_BUTTON)
            ->with('link', $this->router->routeToDestroy($this->modelItem->getAlias(), $instance->getKey()))
            ->with('data-toggle', 'tooltip')
            ->with('title', Lang::get('admin::lang.table.delete'));
	}

	/**
	 * @param ModelWithOrderFieldInterface $instance
	 * @param $totalCount
	 * @return string
	 */
	protected function moveButtons(ModelWithOrderFieldInterface $instance, $totalCount)
	{
		$sort = $instance->getOrderValue();
		$buttons = [];
		if ($sort > 0)
		{
			$buttons[] = $this->moveButton($this->router->routeToMoveup($this->modelItem->getAlias(), $instance->getKey()), Lang::get('admin::lang.table.moveUp'), '&uarr;');
		}
		if ($sort < $totalCount - 1)
		{
			$buttons[] = $this->moveButton($this->router->routeToMovedown($this->modelItem->getAlias(), $instance->getKey()), Lang::get('admin::lang.table.moveDown'), '&darr;');
		}
		return implode(' ', $buttons);
	}

	/**
	 * @param $route
	 * @param $title
	 * @param $label
	 * @return string
	 */
	protected function moveButton($route, $title, $label)
	{
		$content = '';
		$content .= $this->formBuilder->open([
			'method' => 'patch',
			'url'    => $route,
			'class'  => 'inline-block'
		]);
		$content .= $this->htmlBuilder->tag('button', [
			'class'       => 'btn btn-default btn-sm',
			'type'        => 'submit',
			'data-toggle' => 'tooltip',
			'title'       => $title
		], $label);
		$content .= $this->formBuilder->close();
		return $content;
	}

    public function isSortable()
    {
        return false;
    }
} 