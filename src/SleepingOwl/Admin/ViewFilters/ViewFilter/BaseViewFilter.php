<?php namespace SleepingOwl\Admin\ViewFilters\ViewFilter;

use Illuminate\Support\Str;
use SleepingOwl\Admin\Admin;
use SleepingOwl\Admin\ViewFilters\Interfaces\ViewFilterInterface;
use SleepingOwl\Admin\Models\ModelItem;
use Illuminate\Support\Collection;

Abstract Class BaseViewFilter implements ViewFilterInterface
{

    protected $code = 'text';

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value = '';

    /**
     * @var null|string
     */
    protected $label;

    /**
     * @param string $name
     * @param string $label
     */
    function __construct($name, $label = null)
    {
        $this->name = $name;
        $this->label = (is_null($label))
            ? ucwords(str_replace('_', ' ', $name))
            : $label;
        $this->htmlBuilder = Admin::instance()->htmlBuilder;
        $this->modelItem = ModelItem::$current;
    }

    /**
     * @return string
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @return null|string
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * @return string
     */
    public function render($tableId, $filterUniqueKey) {
        return 'This would be some render logic';
    }

    /**
     * @return string
     */
    public function getId($tableId, $filterUniqueKey) {
        return $tableId . '-' . $this->getFilterType() . '-' . $filterUniqueKey;
    }

    /**
     * @return string
     */
    public function getValue() {
        return $this->value;
    }

    abstract public function getFilterType();

}