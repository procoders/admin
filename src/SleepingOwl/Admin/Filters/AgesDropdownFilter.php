<?php

namespace SleepingOwl\Admin\Filters;


class AgesDropdownFilter extends BaseCustomFilter {

    const MAX_ADULTS_NUM = 5;

    const MAX_CHILD_NUM = 5;

    public function getOptions() {
        $method = $this->method;
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

    public function getValue() {
        return \Input::get($this->name);
    }

    private function adults()
    {
        //TODO depends on hotel
        $options['-1'] = '- Adults -';
        for($i = 1; $i <= self::MAX_ADULTS_NUM; $i++) {
            $options['ad'.$i] = $i;
        }
        return $options;
    }

    private function child()
    {
        //TODO depends on hotel
        $options['-1'] = '- Child -';
        for($i = 0; $i <= self::MAX_CHILD_NUM; $i++) {
            $options['ch'.$i] = $i;
        }
        return $options;
    }


}