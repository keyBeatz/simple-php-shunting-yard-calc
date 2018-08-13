<?php

namespace App\Model\Math\Control\InputForm;


interface IInputFormFactory
{
    /**
     * @return InputForm
     */
    public function create(): InputForm;
}