<?php

namespace App\Model\Math\Service\Expression;


class ExpressionFactory
{
    public static function create($value): IExpression
    {
        if (is_numeric($value)) {
            return new Number($value);
        } elseif ($value == '+') {
            return new Plus($value);
        } elseif ($value == '-') {
            return new Minus($value);
        } elseif ($value == '*') {
            return new Multiplier($value);
        } elseif ($value == '/') {
            return new Divider($value);
        } elseif (in_array($value, array('(', ')'))) {
            return new Parenthesis($value);
        }
        throw new \RuntimeException("Non defined expression");
    }
}