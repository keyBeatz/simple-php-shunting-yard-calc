<?php

namespace App\Model\Math\Control\CalcControl;


interface ICalcControlFactory
{
    /**
     * @return CalcControl
     */
    public function create(): CalcControl;
}