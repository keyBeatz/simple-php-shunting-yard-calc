<?php

namespace App\Model\Math\Service\Expression;


use App\Model\Math\Stack;


class Minus extends Operator
{
    protected $precedence = 2;

    public function compute(Stack $stack)
    {
        $left  = $stack->pop()->compute($stack);
        $right = $stack->pop();
        $right = ($right ? $right->compute($stack) : 0);

        return $right - $left;
    }
}