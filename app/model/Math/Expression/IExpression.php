<?php

namespace App\Model\Math\Service\Expression;


use App\Model\Math\Stack;


interface IExpression
{
    public function setValue($value);

    public function getValue();

    public function isOperator(): bool;

    public function isParenthesis(): bool;

    public function getPrecedence(): int;

    public function isLeftParenthesis(): bool;

    public function compute(Stack $stack);
}
