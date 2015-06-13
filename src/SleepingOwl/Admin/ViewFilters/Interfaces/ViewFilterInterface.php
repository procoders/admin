<?php namespace SleepingOwl\Admin\ViewFilters\Interfaces;

interface ViewFilterInterface
{

    public function getName();

    public function getLabel();

    public function render($tableId, $filterUniqueKey);

    public function getId($tableId, $filterUniqueKey);

    public function getValue();

} 