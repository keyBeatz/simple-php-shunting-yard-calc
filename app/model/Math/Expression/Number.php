<?php

namespace App\Model\Math\Service\Expression;

use App\Model\Math\Stack;


class Number extends Expression
{

    public function compute(Stack $stack)
    {
        return $this->value;
    }
}