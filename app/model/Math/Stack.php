<?php

namespace App\Model\Math;


use App\Model\Math\Service\Expression\IExpression;


class Stack
{
    protected $data = [];

    /**
     * @param IExpression $element
     */
    public function push(IExpression $element)
    {
        $this->data[] = $element;
    }

    /**
     * @return IExpression|false
     */
    public function getLast()
    {
        return end($this->data);
    }

    /**
     * @return IExpression|null
     */
    public function pop(): ?IExpression
    {
        return array_pop($this->data);
    }
}