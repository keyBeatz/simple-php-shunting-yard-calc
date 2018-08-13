<?php

namespace App\Model\Math\Service\Expression;


use App\Model\Math\Stack;


class Divider extends Operator
{
    protected $precedence = 3;

    public function compute(Stack $stack)
    {
        $left  = $stack->pop()->compute($stack);
        $right = $stack->pop()->compute($stack);

        return $right / $left;
    }
}