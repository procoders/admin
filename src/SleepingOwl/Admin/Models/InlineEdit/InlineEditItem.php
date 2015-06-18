<?php namespace SleepingOwl\Admin\Models\InlineEdit;

use App;
use Closure;
use SleepingOwl\Admin\Models\Form\FormItem\Checkbox;
use SleepingOwl\Admin\Models\Form\FormItem\Ckeditor;
use SleepingOwl\Admin\Models\Form\FormItem\Date;
use SleepingOwl\Admin\Models\Form\FormItem\File;
use SleepingOwl\Admin\Models\Form\FormItem\ClosureHandler;
use SleepingOwl\Admin\Models\Form\FormItem\Hidden;
use SleepingOwl\Admin\Models\Form\FormItem\Image;
use SleepingOwl\Admin\Models\Form\FormItem\Password;
use SleepingOwl\Admin\Models\Form\FormItem\Select;
use SleepingOwl\Admin\Models\Form\FormItem\Text;
use SleepingOwl\Admin\Models\Form\FormItem\Textarea;
use SleepingOwl\Admin\Models\Form\FormItem\View;
use Illuminate\Support\Arr;
use SleepingOwl\Admin\Models\ModelItem;
use SleepingOwl\Admin\Models\Form\FormItem;

Class InlineEditItem extends FormItem
{
    public static function __callStatic($method, $params)
    {
        $formItem = null;

        if ($handler = static::getHandler($method))
        {
            if ($handler instanceof Closure)
            {
                $formItem = new ClosureHandler($handler);
            } else
            {
                $formItem = App::make($handler);
            }
        } else
        {
            $className = FormItem::class . '\\' . ucfirst($method);

            $formItem = new $className(Arr::get($params, 0, null), Arr::get($params, 1, ''));
        }
        ModelItem::$current->getForm()->addInlineItem($formItem);
        return $formItem;
    }
}