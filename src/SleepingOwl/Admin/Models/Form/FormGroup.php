<?php namespace SleepingOwl\Admin\Models\Form;

use App;
use Closure;
use Illuminate\Support\Arr;
use SleepingOwl\Admin\Models\ModelItem;

class FormGroup
{

    const DISPLAY_TYPE_FULL = 'FULL';
    const DISPLAY_TYPE_HALF = 'HALF';

    protected $code;
    protected $description;
    protected $displayType = self::DISPLAY_TYPE_FULL;


    protected function __construct($code)
    {
        $this->code = $code;
    }

    public function description($description)
    {
        $this->description = $description;
        return $this;
    }

    public function setDisplayType($type)
    {
        $this->displayType = $type;
        return $this;
    }

    static public function create($code, $description)
    {
        $group = new self($code);
        $group->description($description);
        ModelItem::$current->getForm()->addGroup($group);
        return $group;
    }

    public function getCode()
    {
        return $this->code;
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getDisplayType()
    {
        return $this->displayType;
    }

}