<?php

namespace App\Model\Math\Service\Expression;


use App\Model\Math\Stack;


class Parenthesis extends Expression
{
    protected $precedence = 4;

    public function isParenthesis(): bool
    {
        return true;
    }

    public function isLeftParenthesis(): bool
    {
        return $this->value === '(';
    }

    public function compute(Stack $stack)
    {
        return null;
    }
}