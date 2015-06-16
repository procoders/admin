<?php namespace SleepingOwl\Admin\Models\Form\FormItem\Traits;

trait Addon
{
    protected $addon = false;
    protected $addonValue = '';

    public function addon($val)
    {
        $this->addon = (bool)$val;
        return $this;
    }

    public function getAddon()
    {
        return $this->addon;
    }

    public function addonValue($value)
    {
        $this->addonValue = (string)$value;
    }

    public function getAddonValue()
    {
        return (string)$this->addonValue;
    }

}