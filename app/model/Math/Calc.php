<?php

namespace App\Model\Math;

use App\Model\Math\Service\Expression\ExpressionFactory;
use App\Model\Math\Service\Expression\Number;


/**
 * Class Calculator is simple implementation of Shunting-yard algorithm
 * @package App\Model\Math\Service
 */
class Calc
{
    /**
     * @param string $input
     *
     * @return int|float
     */
    public static function calc(string $input): float
    {
        // strip all whitespaces
        $input = preg_replace('/\s+/', '', $input);
        // split string into an array containing single-character per value
        $tokens = preg_split('(([0-9]*\.?[0-9]+|\+|-|\(|\)|\*|\/)|\s+)', $input, null,
            PREG_SPLIT_NO_EMPTY | PREG_SPLIT_DELIM_CAPTURE);

        // prepare our stack collections
        $outputStack   = new Stack;
        $operatorStack = new Stack;

        // prepare stacks
        foreach ($tokens as $token) {
            // convert each token to an Expression object
            $expression = ExpressionFactory::create($token);

            if ($expression instanceof Number) {
                $outputStack->push($expression);
            } elseif ($expression->isOperator()) {
                $last = $operatorStack->getLast();

                if ($last && $last->isOperator()) {
                    // check all operators from the end of the $operatorStack and move them to the $outputStack until
                    // they have greater or equal precedence (maintain correct order) and there is no left parenthesis
                    // this is simplified version of Shunting-yard algorithm without functions and Power Expression
                    while (($end = $operatorStack->getLast()) && $end->isOperator()) {
                        if ($expression->getPrecedence() <= $end->getPrecedence() || $end->isLeftParenthesis()) {
                            $outputStack->push($operatorStack->pop());
                        } else {
                            break;
                        }
                    }
                    $operatorStack->push($expression);

                } else {
                    $operatorStack->push($expression);
                }
            } elseif ($expression->isParenthesis() && $expression->isLeftParenthesis()) {
                // push opening parenthesis to the operatorStack
                $operatorStack->push($expression);
            } elseif ($expression->isParenthesis()) {
                // move all expressions to the $outputStack (if they are not parenthesis)
                while ($end = $operatorStack->pop()) {
                    // break if there is another opening parenthesis
                    if ($end->isParenthesis()) {
                        break;
                    } else {
                        $outputStack->push($end);
                    }
                }
            }
        }

        // move remaining operators from $operatorStack to the top of $outputStack
        while ($operator = $operatorStack->pop()) {
            // if aby parenthesis left, there is an mismatch error
            if ($operator->isParenthesis()) {
                throw new \RuntimeException('Parenthesis missing');
            }
            $outputStack->push($operator);
        }

        // finally, compute $outputStack Expressions
        while (($operator = $outputStack->pop()) && $operator->isOperator()) {
            $value = $operator->compute($outputStack);
            if ($value) {
                $outputStack->push(ExpressionFactory::create($value));
            }
        }

        // since we've implemented only +|-|/|* we expect int|float return only
        return floatval($operator->getValue());
    }
}