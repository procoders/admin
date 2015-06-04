<?php
/**
 * Created by PhpStorm.
 * User: ivens
 * Date: 04.06.2015
 * Time: 14:48
 */

namespace SleepingOwl\Admin\Filters;


class BoolDropdownFilter extends BaseCustomFilter {


    protected $trueValueName;


    public function trueValueName($name)
    {
        $this->trueValueName = $name;
    }

    public function getTrueValueName()
    {
        return $this->trueValueName;
    }

    public function getValue() {
        return \Input::get($this->name);
    }

}