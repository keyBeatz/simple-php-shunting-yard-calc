<?php

namespace App\Model\Math\Service\Expression;


abstract class Expression implements IExpression
{
    protected $precedence = 0;
    protected $value = '';

    public function __construct($value)
    {
        $this->value = $value;
    }

    public function getValue()
    {
        return $this->value;
    }

    public function getPrecedence(): int
    {
        return $this->precedence;
    }

    public function isOperator(): bool
    {
        return false;
    }

    public function isLeftParenthesis(): bool
    {
        return false;
    }

    public function isParenthesis(): bool
    {
        return false;
    }
}