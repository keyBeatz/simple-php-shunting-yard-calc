<?php

namespace App\Model\Math\Service\Expression;


abstract class Operator extends Expression
{
    public function isOperator(): bool
    {
        return true;
    }
}