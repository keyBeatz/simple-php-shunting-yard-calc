<?php

namespace App\Model\Math\Service\Expression;


use App\Model\Math\Stack;


class Multiplier extends Operator
{
    protected $precedence = 3;

    public function compute(Stack $stack)
    {
        return $stack->pop()->compute($stack) * $stack->pop()->compute($stack);
    }
}